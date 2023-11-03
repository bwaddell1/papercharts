<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetAthenaHealthAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'athena-health-appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $token_type = '';
    protected $token = '';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getAccessToken();
        $teams = \App\Models\Team::all();
        foreach($teams as $team) {
            $practice_id = $team->athena_health_practice_id;
            if ($practice_id)
            {
                $providers = $this->getProviderList($practice_id);
                foreach($providers as $provider) {
                    $provider_id = $provider['providerid'];
                    $client = new \GuzzleHttp\Client();
                    $fromDate = \Carbon\Carbon::now()->format('m/d/Y');
                    $toDate = \Carbon\Carbon::now()->addDays(1)->format('m/d/Y');
                    $response = $client->request('GET', "https://api.preview.platform.athenahealth.com/v1/$practice_id/appointments/booked", [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => "$this->token_type $this->token",
                        ],
                        'query' => [
                            'startdate' => $fromDate,
                            'enddate' => $toDate,
                            'providerid' => $provider_id,
                        ]
                    ]);

                    if($response->getStatusCode() == 200) {
                        $body = $response->getBody();
                        $appointments = json_decode($body, true)['appointments'];
                        // $team = \App\Models\Team::where('athena_health_provider_id', $provider_id)->first();
                        foreach($appointments as $appointment) {
                            $appointment_id = $appointment['appointmentid'];
                            $appointment_date = $appointment['scheduleddatetime'];
                            $appointmenttype = $appointment['appointmenttype'];
                            $visit_type = \App\Models\NoteTemplate::where('visit_type', $appointmenttype)->where('team_id', $team->id);
                            // if($team) {
                            //     $visit_type = $visit_type->where('team_id', $team->id);
                            // }
                            $visit_type = $visit_type->first();
                            if(!$visit_type) {
                                $visit_type = \App\Models\NoteTemplate::create([
                                    'team_id' => $team->id,
                                    'visit_type' => $appointmenttype,
                                    'content' => '{"time":1694709745372,"blocks":[{"id":"visit_type","type":"header","data":{"text":"' . $appointmenttype . '","level":1}}],"version":"2.28.0"}',
                                    'status' => 'published',
                                    'vitals' => '[]',
                                    'history' => '[]',
                                    'is_public' => '0',
                                    'footer' => '{}',
                                ]);
                            }
                            $visit = \App\Models\Visit::updateOrCreate([
                                'appointment_id' => $appointment_id,
                                'integration_type' => 'athena-health',
                            ], [
                                'visit_at' => \Carbon\Carbon::parse($appointment_date),
                                'visit_type' => $visit_type->id,
                                'status' => 'not_started',
                                'team_id' => $team->id,
                                'first_name' => '',
                                'last_name' => '',
                                'user_id' => 1,
                            ]);
                            $patient_id = $appointment['patientid'];
                            $patient_info = $this->getPatientInfo($practice_id, $patient_id);
                            if($patient_info) {
                                $visit->first_name = $patient_info['firstname'];
                                $visit->last_name = $patient_info['lastname'];
                                $visit->birthdate = \Carbon\Carbon::parse($patient_info['dob']);
                                $visit->save();
                            }
                        }
                    }
                }
            }
        }
        // $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST', "https://neightn-k4srdc-microtica.microtica.rocks/webhook-test/athena-health-providers-dev", [
        //     'form_params' => [
        //         'practiceId' => '195900',
        //     ]
        // ]);

        // if($response->getStatusCode() == 200) {
        //     $body = $response->getBody();
        //     $provider_id_list = array_map(function($item) {
        //         return $item['providerid'];
        //     }, json_decode($body, true)['providers']);
        //     foreach($provider_id_list as $provider_id) {

        //     }
        // }
        return Command::SUCCESS;
    }

    public function getAccessToken()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', "https://api.preview.platform.athenahealth.com/oauth2/v1/token", [
            'headers' => [
                'Accept' => 'application/json, text/plain, */*',
                'Authorization' => 'Basic MG9hbGlyODZwc0ZMblVzRUcyOTc6dXBaTjljWTA3cGE5dmZGYmJNQUREdDdfbWpHTmxpbEFCOWdwSmJoVjJKMF9RZFFVZ3BIeFJDdlBraXc4N200eA==',
            ],
            'form_params' => [
                'scope' => 'athena/service/Athenanet.MDP.*',
                'grant_type' => 'client_credentials',
            ]
        ]);

        if($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $this->token_type = json_decode($body, true)['token_type'];
            $this->token = json_decode($body, true)['access_token'];
        }
    }

    public function getProviderList($practice_id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', "https://api.preview.platform.athenahealth.com/v1/$practice_id/providers", [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "$this->token_type $this->token",
            ],
        ]);

        if($response->getStatusCode() == 200) {
            $body = $response->getBody();
            return json_decode($body, true)['providers'];
        }
    }

    public function getPatientInfo($practice_id, $patient_id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', "https://api.preview.platform.athenahealth.com/v1/$practice_id/patients/$patient_id", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "$this->token_type $this->token",
                ],
            ]);

            if($response->getStatusCode() == 200) {
                $body = $response->getBody();
                return json_decode($body, true)[0];
            }
        }
        catch(\Exception $e) {
            return null;
        }
    }
}
