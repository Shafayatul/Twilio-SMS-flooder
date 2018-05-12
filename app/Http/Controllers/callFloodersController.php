<?php

namespace App\Http\Controllers;

use App\CallFlooder;
use App\Audio;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;
use App\TwilioCredential;

use Twilio\Exceptions\TwilioException;
use Twilio\Http\CurlClient;
use Twilio\Rest\Client;
use Twilio\Twiml;

class CallFloodersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show all calls
        $callFlooders = CallFlooder::latest()->paginate(20);
        $audios = Audio::pluck('name','id');
        return view('callFlooders.index',compact('callFlooders','audios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $audios = Audio::pluck('name','id');
        return view('callFlooders.create',compact('audios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'seconds' => 'required',
            'numbers' => 'required',
            'num_of_calls' => 'required',
            'audio_id' => 'required',
            'from' => 'required',
        ]);
        CallFlooder::create($request->all());
        Session::flash('success','Call Flooder has been successfully added!');
        return redirect()->route('callFlooders.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CallFlooder  $callFlooder
     * @return \Illuminate\Http\Response
     */
    public function show(CallFlooder $callFlooder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CallFlooder  $callFlooder
     * @return \Illuminate\Http\Response
     */
    public function edit(CallFlooder $callFlooder)
    {
        $audios = Audio::pluck('name','id');
        return view('callFlooders.edit',compact('callFlooder','audios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CallFlooder  $callFlooder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CallFlooder $callFlooder)
    {
        $this->validate($request,[
            'name' => 'required',
            'seconds' => 'required',
            'numbers' => 'required',
            'num_of_calls' => 'required',
            'audio_id' => 'required',
            'from' => 'required',
        ]);
        $callFlooder->update($request->all());
        Session::flash('success','Call Flooder has been successfully edited!');
        return redirect()->route('callFlooders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CallFlooder  $callFlooder
     * @return \Illuminate\Http\Response
     */
    public function destroy(CallFlooder $callFlooder)
    {
        //
    }

    public function ajaxDelete(Request $request) 
    {
        $id = $request->input('id');
        $callFlooder = callFlooder::find($id);
        $callFlooder->delete();
        $response = array(
            'status' => 'success',
        );
        return \Response::json($response);
    }    

    /**
    * below is for only test purpose 
    */


    public function makeCallPage($id,$minutes=0)
    {
        // get info of call flooder
        $callFlooder = callFlooder::find($id);

        $audio = Audio::find($callFlooder->audio_id);
        // $audio_file_url = Storage::url($audio->file);
        $audio_file_url = $audio->file;

        $twilioCredential = TwilioCredential::find(1);
        

        return view('callFlooders.makeCall',compact('callFlooder','audio_file_url','twilioCredential','minutes'));
    }



    public function xmlCallResponse($fileName)
    {
        $url = url('/storage/').'/'.$fileName;
		$response = new Twiml();
		$response->play($url);
		return $response;   
    }

    public function postAjaxTwilioCall()
    {

        $to = str_replace(" ", "+", $_POST["number"]);
        $from = str_replace(" ", "+", $_POST["from"]);
        $audioUrl = $_POST["audioUrl"];

        //create our twilio client
        $this->twilioClient = new Client($_POST["sid"], $_POST["token"]);

        //turn off ssl verify
        $this->twilioClient->setHttpClient( new CurlClient([
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]));


        $tt = "";
        try
        {
            $call = $this->twilioClient->calls->create(
                $to, // Call this number
                $from, // From a valid Twilio number
                array(
                    // 'Record'           => true,
                    'url'              => 'http://demo.twilio.com/welcome/voice/',
                    // 'MachineDetection' => self::TWILIO_AMD_ENABLED
                )
            );

            $tt .= "Starting call to: {$call->to}: from: {$call->from}\n";

        }
        catch (TwilioException $e)
        {
            $tt .= "Error on number - $fromNumber: {$e->getMessage()}\n";
        }

        // response
        $response = array(
	        'status' => 'success',
            'tt' => $tt,
            'call' => $call,
        );
        return \Response::json($response);
    }

    // test code ends



}
