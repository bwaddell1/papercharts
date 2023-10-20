<?php

namespace App\Jobs;

use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use OpenAI\Laravel\Facades\OpenAI;

class GenerateNoteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $visit_id, $prompt;

    private $placeholder = '{"time":1694709745372,"blocks":[{"id":"description","type":"paragraph","data":{"text":"","alignment":"left"}}],"version":"2.28.0"}';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($visit_id, $prompt)
    {
        $this->visit_id = $visit_id;
        $this->prompt = $prompt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->generate_note();
    }

    public function generate_note()
    {
        $visit = Visit::find($this->visit_id);
        $template = $visit->visitType->content;
        $sample_template = $visit->visitType->sample_note ? jsonToText($visit->visitType->sample_note) : "";

        $messages[] = [
            'role' => 'system',
            'content' => "You are a medical scribe helping write physician documentation. I will give you a short explanation and you will turn it into a complete encounter note. Be Concise.
            Here is the short explanation: \"$this->prompt\"
            Here is a similar note as to how the result should look:
            
            *************************************
            $sample_template
            *************************************

            Additionally please write and suggest an ICD10 code for the diagnosis",
        ];

        Log::channel('openai')->info('AI Content Generating......');
        Log::channel('openai')->info(json_encode($messages));

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4',
            'messages' => $messages,
        ]);

        // OpenAI returns choices array, so select the first one
        $content = $response['choices'][0]['message']['content'];

        Log::channel('openai')->info('CHATGPT Result');
        Log::channel('openai')->info($content);

        if ($content) {
            $placeholder_string = json_decode($this->placeholder, true);
            $placeholder_string['blocks'][0]['data']['text'] = nl2br($content);
            // $jsonData now contains the parsed JSON
            $visit->note_content = $placeholder_string;
            $visit->status = "complete";
            $visit->save();
        } else {
            Log::channel('openai')->info('ChatGPT generate failed!');
            $this->generate_note();
        }
        
    }
}
