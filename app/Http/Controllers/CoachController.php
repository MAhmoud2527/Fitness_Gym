<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userstable;
use App\Models\country;

class CoachController extends Controller
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
        $data = userstable::paginate(10)->where('usertype_id', 3)->where('add_by', $id);
        return view('coach.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $data = country::get();
        return view('coach.create', ['data' => $data]);
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
            'photo' => 'required|image|mimes:png,jpeg,jpg,gif',
        ]);
        # upload image ...

        $finalName = time() . rand() . '.' . $request->photo->extension();

        $request->photo->move(public_path('images'), $finalName);
        $data['photo'] = $finalName;
        $data['password'] = bcrypt($data['password']);

        $op = userstable::create(['username' => $data['username'], 'email' => $data['email'], 'password' => $data['password'], 'phone' => $data['phone'], 'country_id' => $data['country_id'], 'photo' => $data['photo'], 'usertype_id' => 3, 'add_by' => $id]);
        if ($op) {
            $message = 'One Coach Inserted';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/coach'));
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
        $country = country::get();
        $data = userstable::select('users.*', 'country.country_name')->join('country', 'country.id', '=', 'users.country_id')->where('users.id', $id)->get();
        return view('coach.edit')->with('data', $data)->with('country', $country);
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
        $id = $request->id;
        $user = userstable::find($id);
        $path = public_path() . '/images/';
        $photo_old = $path . $user->photo;
        $data = $this->validate(request(), [
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'country_id' => 'required',
            'photo' => 'image|mimes:png,jpeg,jpg,gif',
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

        $op = userstable::where('id', $request->id)->update(['username' => $data['username'], 'email' => $data['email'], 'phone' => $data['phone'], 'country_id' => $data['country_id'], 'photo' => $finalName]);

        if ($op) {

            $message = 'One Coach Updated';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/coach'));
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
            $message = 'One Coach Deleted';

            unlink($photo_old);
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('coach'));
    }
}
