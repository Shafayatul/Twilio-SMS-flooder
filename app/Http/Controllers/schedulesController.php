<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\CallFlooder;
use Illuminate\Http\Request;
use Session;

class schedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callFlooders = CallFlooder::pluck('name','id');
        $schedules = Schedule::orderBy('id', 'DESC')->get();
        return view('schedules.index',compact('schedules','callFlooders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $callFlooders = CallFlooder::pluck('name','id');
        return view('schedules.create',compact('callFlooders'));
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
            'call_flooder_id' => 'required',
            'minutes' => 'required',
            'date' => 'required',
        ]);
        Schedule::create($request->all());
        Session::flash('success','Schedule has been successfully added!');
        return redirect()->route('schedules.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $callFlooders = CallFlooder::pluck('name','id');
        return view('schedules.edit',compact('schedule', 'callFlooders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->validate($request,[
            'name' => 'required',
            'call_flooder_id' => 'required',
            'minutes' => 'required',
            'date' => 'required',
        ]);
        $schedule->update($request->all());
        Session::flash('success','Schedule has been successfully added!');
        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    public function ajaxDelete(Request $request) 
    {
        $id = $request->input('id');
        $schedule = Schedule::find($id);
        $schedule->delete();
        $response = array(
            'status' => 'success',
        );
        return \Response::json($response);
    }   

}
