<?php

namespace App\Http\Controllers;

use App\TwilioCredential;
use Illuminate\Http\Request;

class TwilioCredentialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('twilioCredentials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TwilioCredential  $twilioCredential
     * @return \Illuminate\Http\Response
     */
    public function show(TwilioCredential $twilioCredential)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TwilioCredential  $twilioCredential
     * @return \Illuminate\Http\Response
     */
    public function edit(TwilioCredential $twilioCredential)
    {
        return view('twilioCredentials.edit',compact('twilioCredential'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TwilioCredential  $twilioCredential
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TwilioCredential $twilioCredential)
    {
        $this->validate($request,[
            'sid' => 'required',
            'token' => 'required',
        ]);

        $twilioCredential->update($request->all());
        return redirect()->route('twilioCredentials.edit', $twilioCredential->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TwilioCredential  $twilioCredential
     * @return \Illuminate\Http\Response
     */
    public function destroy(TwilioCredential $twilioCredential)
    {
        //
    }
}
