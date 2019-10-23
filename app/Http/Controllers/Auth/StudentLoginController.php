<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
  // use AuthenticatesUsers;
  
	public function __construct()
	{
		// $this->middleware('guest:student');
    $this->middleware('guest:student')->except('logout');
	}

	public function login()
	{
      session()->put('url.intended',url()->previous());
  		return view('student.auth.login');
	}

    public function loginStudent(Request $request)
    {
      $credentials = $request->only('id_number', 'password');
      // Attempt to log the user in
      if (Auth::guard('student')->attempt($credentials, $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('student.dashboard'));
      } 
      return back()->withInput($request->only('id_number', 'remember'))
                    ->withErrors(['message' => 'Please check your ID number or password.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.auth.login');
    }
}
