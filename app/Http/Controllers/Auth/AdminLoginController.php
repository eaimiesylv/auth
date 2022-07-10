<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use DB;

class AdminLoginController extends Controller
{

    public function __construct()
    {
       // $this->middleware('guest:admin');
    }
 
    public function showLoginForm(){

        return view('auth.admin-login');
    }
    public function login(Request $request){

        //validate the form data
		$request->validate([
			'email'=>'required',
			'password'=>'required'
		]);
		//attempt to login the user_error
		$k=Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember);
			//redirects to the intended location. route is the default url
		if($k){
			return redirect()->intended(route('admin'));
		}
		//failed login, then redirect back to the login with the email and remembr
		return redirect()->back()->withInput($request->only('email','remember'));
    }
	public function showRegisterForm(){

        return view('adminregister');
    }
	public function LoginRegister(Request $request){
			return Admin::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				]);
	}
}
