<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userstable;
use App\Models\country;
use App\Models\trainee;
use App\Models\package;

class CoachViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = auth('gym')->user()->id;
        $data = userstable::select('users.*', 'trainees_more_info.*')
            ->join('trainees_more_info', 'trainees_more_info.more_trainee', '=', 'users.id')
            ->where('trainees_more_info.coach_id', $id)
            // ->join('package', 'package.id', '=', 'trainees_more_info.package_id')
            // ->where('trainees_more_info.package_id', 'package.id')
            // ->join('country', 'country.id', '=', 'users.country_id')
            // ->where('users.country_id', 'country.id')
            ->get();
        return view('coachView.index', ['data' => $data]);
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
