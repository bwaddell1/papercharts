<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use thiagoalessio\TesseractOCR\TesseractOCR;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Visit;
use Log;

class OcrVisitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ocr_result = (new TesseractOCR($this->filename))->run();
        $pythonScript = public_path('scanning/omr.py');
        $arguments = ['--input', $this->filename, '--output-dir', "./"]; // Replace with your desired arguments
        $QRCodeReader = new \Libern\QRCodeReader\QRCodeReader();
        $qrcode_text = $QRCodeReader->decode($this->filename);
        $qrcode_info = json_decode($qrcode_text, true);
        $visit_id = $qrcode_info['visit_id'];
        $user_id = $qrcode_info['user_id'];

        $omr_result = shell_exec("python3 $pythonScript " . implode(' ', $arguments));        
        Log::channel('openai')->info($omr_result);
        Log::channel('openai')->info($ocr_result);
        $result = $this->generate_note($visit_id, $user_id, $ocr_result, $omr_result);
    }

    public function generate_note($visit_id, $user_id, $ocr_result, $omr_result)
    {
        $visit = Visit::find($visit_id);
        $template = $visit->visitType->content;
        $sample_template = $visit->visitType->sample_note ?? "";

        $messages[] = [
            'role' => 'system',
            'content' => "You are a medical scribe helping write physician documentation. I will give you a short explanation and you will turn it into a complete encounter note. Be Concise.
            Here is the ocr result of doctor's documentation. you can ignore typos: 

            *************************************
            $ocr_result

            *************************************
            Here is the omr result of doctor's documentation. you can update checked value of json checkbox fields based on this data. you can ignore typos:
            $omr_result
            *************************************

            
            
            The note should be in JSON format. 
            Here is JSON that you should use: $template

            You can add note informations to \"text\" fields of JSON or replace \"___\" with the correct information. Also you can change \"checked\" value of \"checklist\" fields to \"true\" based on explanation.
            ** MOST IMPORTANT ** You cannot change any structure of JSON in any case. You should keep all structures of JSON and just add informations.

            Additionally please write and suggest an ICD10 code for the diagnosis",
        ];

        Log::channel('openai')->info(json_encode($messages));

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4',
            'messages' => $messages,
        ]);

        // OpenAI returns choices array, so select the first one
        $content = $response['choices'][0]['message']['content'];

        Log::channel('openai')->info('CHATGPT Result');
        Log::channel('openai')->info($content);

        try {
            $startIndex = strpos($content, '{');
            $endIndex = strrpos($content, '}');
            $jsonString = substr($content, $startIndex, $endIndex - $startIndex + 1);

            // Parse the JSON data
            $jsonData = json_decode($jsonString, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                // $jsonData now contains the parsed JSON
                $visit->note_content = $jsonString;
                $visit->status = "complete";
                $visit->save();
            } else {
                Log::channel('openai')->info('JSON parsing failed!');
                return $this->generate_note($visit_id, $user_id, $ocr_result, $omr_result);
            }
        } catch (\Exception $ex) {
            Log::channel('openai')->info('JSON parsing failed!');
            return $this->generate_note($visit_id, $user_id, $ocr_result, $omr_result);
        }
        return true;
    }
}
