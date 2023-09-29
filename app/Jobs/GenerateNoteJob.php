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

        $messages[] = [
            'role' => 'system',
            'content' => "You are a medical scribe helping write physician documentation. I will give you a short explanation and you will turn it into a complete encounter note. Be Concise.
            Here is the short explanation: \"$this->prompt\"
            The note should be in JSON format. Here is a similar note as to how the result should look:
            Hpi:
            A 5 year old previously healthy female presented with 3 days of right sided ear pain. She has also had fever, and some rhinorrhea. No other symptoms
            Exam:
            Gen: Well appearing, in no distress
            HEENT: Right TM is erythematous and bulging, Left TM is normal. Eyes are PERLLA.
            CV: RRR no murmur
            RESP: CTAB no wheezing, normal respiratory rate
            GI: Abdomen is soft, non-tender, non distended, normal bowel sounds
            Derm: No rashes
            Assessment: Right Otitis Media (ICD10: 898..8)
            Plan:
            1. Amoxicillin 400mg/5ml take 5 ml twice daily for ten days
            2. Tylenol or Motrin for pain relief as needed
            3. Follow up in 3-5 days if having persistent fevers\"

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
                $visit->save();
            } else {
                Log::channel('openai')->info('JSON parsing failed!');
                $this->generate_note();
            }
        } catch (\Exception $ex) {
            Log::channel('openai')->info('JSON parsing failed!');
            $this->generate_note();
        }
    }
}
