<?php

namespace App\Http\Controllers;

use App\thing;
use Illuminate\Http\Request;

use App\Repositories\UserRepository;

class ThingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'rewrw';
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
    public function store(Request $request)
    {
        //
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
