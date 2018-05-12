<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class audiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show all audios in table
        $audios = Audio::orderBy('id','desc')->paginate(20);
        return view('audios.index')->with('audios', $audios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // add new audio
        return view("audios.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request,array(
            'name' => 'required|max:255',
            'file' => 'required'
        ));

        // upload audio file and get the link
        $audio_file_format_array = array('wav', 'aif', 'mp3', 'mid', 'mpga');
        if (($request->hasFile('file')) && (in_array($request->file->extension(), $audio_file_format_array)) ) {
            $url = Storage::disk('public')->put('', $request->file('file'));
            // $audio_file_url = Storage::url($url);

            // store in database
            $audio = new Audio;
            $audio->name = $request->name;
            $audio->file = $url;
            $audio->save();
            Session::flash('success','Audio file has been successfully added!');

        }else{
            Session::flash('error','Audio file format is not correct.');
        }

                
        // redirect someone to another page
        return redirect()->route("audios.create");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function show(audio $audio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function edit(audio $audio)
    {
        return view('audios.edit',compact('audio'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, audio $audio)
    {
        // $id = $audio->id;
        $this->validate($request,[
            'name' => 'required',
        ]);
        // upload audio file and get the link
        $audio_file_format_array = array('wav', 'aif', 'mp3', 'mid', 'mpga');
        if (($request->hasFile('file')) && (in_array($request->file->extension(), $audio_file_format_array)) ) {

            //delete old file
            Storage::disk('public')->delete($audio->file);

            //upload new file
            $url = Storage::disk('public')->put('', $request->file('file'));

            // update in database
            $audio->name = $request->name;
            $audio->file = $url;
            $audio->save();
            Session::flash('success','Audio file has been successfully updated!');
        }else{
            // update in database
            $audio->name = $request->name;
            $audio->save();
            Session::flash('success','Audio file has been successfully updated!');
        }

        return redirect()->route('audios.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy(audio $audio)
    {


    }

    public function ajaxDelete(Request $request) {
        $id = $request->input('id');
        $audio = Audio::find($id);

        // delete the audio file

        Storage::disk('public')->delete($audio->file);

        $audio->delete();
        $response = array(
            'status' => 'success',
        );
        return \Response::json($response);
    }

}
