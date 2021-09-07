<?php

namespace App\Http\Controllers;

use App\Models\userstable;
use App\Models\usertype;
use App\Models\country;
use App\Models\package;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {

        $this->middleware('checkAuth', ['except' => ['login', 'doLogin']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = userstable::get()->where('usertype_id', 2);
        return view('admin.index', ['data' => $data]);
    }
    public function dashboard()
    {
        //
        $data1 = userstable::get()->where('usertype_id', 2);
        $manager = count($data1);
        $data2 = userstable::get()->where('usertype_id', 3);
        $coach = count($data2);
        $data3 = userstable::get()->where('usertype_id', 4);
        $trainee = count($data3);
        $data4 = package::get();
        $package = count($data4);

        return view('admin.home', ['coach' => $coach])->with('trainee', $trainee)->with('package', $package)->with('manager', $manager);
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
        return view('admin.create', ['data' => $data]);
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

        $op = userstable::create(['username' => $data['username'], 'email' => $data['email'], 'password' => $data['password'], 'phone' => $data['phone'], 'country_id' => $data['country_id'], 'photo' => $data['photo'], 'usertype_id' => 2, 'add_by' => $id]);
        if ($op) {
            $message = 'One Manager Inserted';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/admin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userstable  $userstable
     * @return \Illuminate\Http\Response
     */
    public function show(userstable $userstable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userstable  $userstable
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $country = country::get();
        $data = userstable::select('users.*', 'country.country_name')->join('country', 'country.id', '=', 'users.country_id')->where('users.id', $id)->get();
        return view('admin.edit')->with('data', $data)->with('country', $country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userstable  $userstable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
            $message = 'One Manager Updated';
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('/admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userstable  $userstable
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
            $message = 'One Manager Deleted';

            unlink($photo_old);
        } else {
            $message = 'Error try again';
        }
        session()->flash('Message', $message);
        return redirect(url('admin'));
    }
    public function login()
    {
        //
        $data = usertype::get();
        return view('login', ['data' => $data]);
    }
    public function doLogin(Request $request)
    {
        //
        $data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'usertype_id' => 'required'
        ]);
        $status = false;
        if ($request->has('rememberMe')) {
            $status = true;
        }
        if (auth('gym')->attempt($data, $status)) {
            if ($data['usertype_id'] == 1) {
                return redirect(url('/dashboard'));
            } elseif ($data['usertype_id'] == 2) {
                return redirect(url('/home'));
            } elseif ($data['usertype_id'] == 3) {
                return redirect(url('/coachview'));
            } elseif ($data['usertype_id'] == 4) {
                return redirect(url('/traineeview'));
            }
        } else {
            $message = 'Invalid Credentials try again';
            session()->flash('Message', $message);
            return redirect(url('/login'));
        }
    }
    public function logout()
    {

        auth('gym')->logout();

        return redirect(url('/login'));
    }
}
