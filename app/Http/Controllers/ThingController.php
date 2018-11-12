<?php

namespace App\Http\Controllers;

use App\thing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ThingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $thing = thing::where('user_id', $id)->firstOrFail();
        Log::info($id);
        return $thing;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       return view('things.create'); 
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
        $user = $request->user();
        $thing = thing::where('user_id', $user->id)->first();
        if (!$thing) {
          $thing = new thing;
          $thing->user_id = $user->id;
          $thing->jdata = $request->tdata;
          $thing->save();
        }
        Log::info($thing);
        return $thing;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function show(thing $thing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function edit(thing $thing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, thing $thing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function destroy(thing $thing)
    {
        //
    }
}
