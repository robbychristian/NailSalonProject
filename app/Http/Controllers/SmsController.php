<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSmsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.sms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSmsRequest $request)
    {
        // $users = User::with('userProfile')->where('is_notify', 1)->get();
        // $receiverNumbers = $users->pluck('userProfile.contact_no')->toArray();

        $receiverNumbers = [
            "+639686079696",
            "+639276054756"
        ];

        // return $receiverNumbers;

        $basic  = new \Vonage\Client\Credentials\Basic(env("VONAGE_API_KEY"), env("VONAGE_API_SECRET"));
        $client = new \Vonage\Client($basic);

        //check balance
        // $response = $client->account()->getBalance();
        // echo round($response->getBalance(), 2) . " EUR\n";

        foreach ($receiverNumbers as $number) {
            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS($number, "Nail Salon", $request->message_content)
            );

            $message = $response->current();

            if ($message->getStatus() == 0) {
                echo "The message was sent successfully\n";
                // return redirect()->back()->with('success', 'You have successfully sent the message!');
            } else {
                echo "The message failed with status: " . $message->getStatus() . "\n";
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
