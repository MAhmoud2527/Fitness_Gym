<?php

namespace App\Http\Controllers;

use App\Models\userstable;
use App\Models\usertype;
use App\Models\package;
use Illuminate\Http\Request;

class ManagerController extends Controller
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
        $data = package::get()->where('add_by', $id);
        return view('package.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('package.create');
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
        $id = auth('gym')->user()->id;
        $data = $this->validate(request(), [
            'package_name' => 'required',
            'month_num' => 'required|numeric',
            'package_amount' => 'required|numeric'
        ]);
        // dd($data);
        $op = package::create(['package_name' => $data['package_name'], 'month_num' => $data['month_num'], 'package_amount' => $data['package_amount'], 'add_by' => $id]);
        if ($op) {
            $message = 'One Package Inserted';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/package'));
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
        $data = package::where('id', $id)->get();

        return view('package.edit', ['data' => $data]);
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
        $id = auth('gym')->user()->id;
        $data = $this->validate(request(), [
            'package_name' => 'required',
            'month_num' => 'required|numeric',
            'package_amount' => 'required|numeric'
        ]);
        // dd($data);
        $op = package::where('id', $request->id)->update(['package_name' => $data['package_name'], 'month_num' => $data['month_num'], 'package_amount' => $data['package_amount'], 'add_by' => $id]);
        if ($op) {
            $message = 'One Package Inserted';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/package'));
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
        $op =  package::where('id', $id)->delete();
        if ($op) {
            $message = 'One Manager Deleted';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/package'));
    }
}
