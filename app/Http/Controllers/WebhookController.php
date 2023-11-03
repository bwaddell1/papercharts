<?php

namespace App\Http\Controllers;

use App\Events\ZapierEvent;
use App\Models\TeamInvitation;
use App\Models\User;
use App\Models\Role;
use Auth;
use Event;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', "https://api.preview.platform.athenahealth.com/v1/0oalir86psFLnUsEG297/appointments/booked", [
            'headers' => [
                'Authorization' => 'Bearer ' . 'upZN9cY07pa9vfFbbMADDt7_mjGNlilAB9gpJbhV2J0_QdQUgpHxRCvPkiw87m4x',
            ],
            'query' => [
                'startdate' => '01/01/2019',
                'enddate' => '01/01/2023',
            ]
        ]);

        echo $response->getStatusCode(); // 200
        echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
        return response()->json($response->getBody());
    }
}
