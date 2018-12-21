<?php

namespace App\Http\Controllers;

use App\Text;
use Illuminate\Http\Request;
use \Nexmo\Client\Credentials\Basic;
use \Nexmo\Client;

class NexmoAPIController extends Controller
{
    /**
     * @param Request $request
     * @return array|mixed|\Nexmo\Message\Message
     * @throws Client\Exception\Exception
     * @throws Client\Exception\Request
     * @throws Client\Exception\Server
     * @throws \Exception
     */
    public function sendText(Request $request){

        if($request->has('message') && $request->has('number')) {
            if ($request->has('secret') && $request->input('secret') == env("NEXMO_API_SECRET")) {
                if ($request->has("key") && $request->input("key") == env("NEXMO_API_KEY")) {
                    //http://myfamily.pbndev.net/api/sendText?message=hello&number=12182805085&key=$key&secret=$secret
                    $message = $request->input('message');
                    $number = $request->input('number');
                    $basic  = new Basic(env("NEXMO_API_KEY"), env("NEXMO_API_SECRET"));
                    $client = new Client($basic);
                    $response = $client->message()->send([
                        'to' => $number,
                        'from' => '12109619101',
                        'text' => $message,
                        'format' =>"json"
                    ]);
                    return (array)$response->getResponseData();
                }
            }
        }
        $response = ["error" => "Wrongly Formed Request"];
        return $response;
    }

    public function getText(Request $request)
    {
        if ($request->has('number')) {
            if ($request->has('secret') && $request->input('secret') == env("NEXMO_API_SECRET")) {
                if ($request->has("key") && $request->input("key") == env("NEXMO_API_KEY")) {
                    //http://myfamily.pbndev.net/api/getText?number=12182805085&key=$key&secret=$secret
                    $response = Text::where("msisdn", $request->input('number'))->first();
                    if($response)
                        return $response;
                    return ["error" => "Unable to retrieve text"];
                }
            }
        }
        return ["error" => "Unable to retrieve text"];
    }

    public function deleteText(Request $request)
    {
        if ($request->has('messageID')) {
            if ($request->has('secret') && $request->input('secret') == env("NEXMO_API_SECRET")) {
                if ($request->has("key") && $request->input("key") == env("NEXMO_API_KEY")) {
                    //http://myfamily.pbndev.net/api/deleteText?messageID=1&key=$key&secret=$secret
                    Text::where("id", $request->input('messageID'))->delete();
                }
            }
        }
        return ["error" => "Unable to retrieve text"];
    }
}
