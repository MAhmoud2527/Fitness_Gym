<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userstable;
use App\Models\country;
use App\Models\trainee;
use App\Models\package;

class TraineeController extends Controller
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
        // $data = userstable::paginate(10)->where('usertype_id', 4);
        $data = userstable::select('users.*', 'trainees_more_info.id as trainee_id')
            ->join('trainees_more_info', 'trainees_more_info.more_trainee', '=', 'users.id')->where('trainees_more_info.more_add_by', $id)->get();
        return view('trainee.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $id = auth('gym')->user()->id;
        $country = country::get();
        $coach = userstable::get()->where('usertype_id', 3)->where('add_by', $id);
        $package = package::get()->where('add_by', $id);
        return view('trainee.create')->with('country', $country)->with('coach', $coach)->with('package', $package);
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
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required|numeric',
            'country_id' => 'required',
            'photo' => 'required|image|mimes:png,jpeg,jpg,gif'
        ]);
        $data2 = $this->validate(request(), [
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'package_id' => 'required',
            'coach_id' => 'required'
        ]);

        # upload image ...

        $finalName = time() . rand() . '.' . $request->photo->extension();

        $request->photo->move(public_path('images'), $finalName);
        $data['photo'] = $finalName;
        $data['password'] = bcrypt($data['password']);
        // dd($data);
        $op = userstable::create(['username' => $data['username'], 'email' => $data['email'], 'password' => $data['password'], 'phone' => $data['phone'], 'country_id' => $data['country_id'], 'photo' => $data['photo'], 'usertype_id' => 4, 'add_by' => $id]);

        // // Second Insert

        $last_id = $op->id;
        $op2 = trainee::create(['weight' => $data2['weight'], 'height' => $data2['height'], 'package_id' => $data2['package_id'], 'coach_id' => $data2['coach_id'], 'more_trainee' => $last_id, 'more_add_by' => $id]);

        if ($op2) {
            $message = 'One Trainee Inserted';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/trainee'));
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
        $related_id = auth('gym')->user()->id;
        $country = country::get();
        $coach = userstable::get()->where('usertype_id', 3)->where('add_by', $related_id);
        $package = package::get()->where('add_by', $related_id);
        $data = userstable::select('users.*', 'trainees_more_info.id as trainee_id',  'trainees_more_info.weight', 'trainees_more_info.height')
            ->join('trainees_more_info', 'trainees_more_info.more_trainee', '=', 'users.id')->where('trainees_more_info.more_add_by', $related_id)->where('users.id', $id)->get();

        return view('trainee.edit', ['data' => $data])->with('country', $country)->with('coach', $coach)->with('package', $package);
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
        $related_id = auth('gym')->user()->id;
        // $id = $request->id;
        $user = userstable::find($id);
        $path = public_path() . '/images/';
        $photo_old = $path . $user->photo;
        $data = $this->validate(request(), [
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'country_id' => 'required',
            'photo' => 'image|mimes:png,jpeg,jpg,gif',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'package_id' => 'required',
            'coach_id' => 'required'
        ]);
        if ($request->has('photo')) {
            //code for remove old Image
            unlink($photo_old);
            $finalName = $request->photo;
            $finalName = time() . rand() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $finalName);
        } else {
            $finalName = $user->photo;
        }

        $op = userstable::where('id', $id)->update(['username' => $data['username'], 'email' => $data['email'], 'phone' => $data['phone'], 'country_id' => $data['country_id'], 'photo' => $finalName]);
        $op2 = trainee::where('more_trainee', $id)->update(['weight' => $data['weight'], 'height' => $data['height'], 'package_id' => $data['package_id'], 'coach_id' => $data['coach_id'], 'more_add_by' => $related_id, 'more_trainee' => $id]);
        if ($op2) {

            $message = 'One Trainee Updated';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/trainee'));
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
        $user = userstable::find($id);
        $path = public_path() . '/images/';
        $photo_old = $path . $user->photo;
        $op =  userstable::where('id', $id)->delete();
        if ($op) {
            $message = 'One Trainee Deleted';

            unlink($photo_old);
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('trainee'));
    }
}
