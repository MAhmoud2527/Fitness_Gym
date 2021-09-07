<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\userstable;
use App\Models\usertype;
use App\Models\package;

class viewHomeController extends Controller
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
        $data = userstable::get()->where('add_by', $id)->where('usertype_id', 3);
        $count = count($data);
        $data2 = userstable::get()->where('add_by', $id)->where('usertype_id', 4);
        $trainee = count($data2);
        $data3 = package::get()->where('add_by', $id);
        $package = count($data3);
        return view('home.index', ['coach' => $count])->with('trainee', $trainee)->with('package', $package);
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
