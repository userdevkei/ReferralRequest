<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct(){

        $this->middleware('auth', ['except' => ['signIn', 'login']]);
    }

    public function signIn(){

        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
           'username' => 'required|string',
           'password' => 'required|string',
        ]);

        $logins = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($logins, true)) {

            return redirect()->route('user.dashboard')->with('success', 'Welcome' . " " . Auth::user()->name);

        }else{

            return redirect()->back()->with('error', 'Oops!! Confirm your logins');
        }

    }

    public function dashboard(){
        if (Auth::check()){

           return redirect()->route('admin.dashboard')->with('success', 'Welcome | Logged in successfully.');
        }else{

            return redirect()->route('user.signIn')->with('warning', 'Oops!! You are logged out. Please login again');
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect()->route('user.signIn')->with('info', 'You are logged out');
    }

    public function admin(){
        // $patients = Patients::count();
        // $physicians = Physicians::count();
        // $referals = Referals::count();
        // $referalfeedback = Referalfeedback::count();
        $facilities = Facilities::count();
        return view('admin.index', compact('facilities'));
    }

    public function doctor(){
        return view('doctor.index');
    }
}
