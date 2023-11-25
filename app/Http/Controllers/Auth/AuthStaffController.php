<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthStaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login-staff');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {
            $user = auth()->user();
            if ($user->user_role == 3) {
                return redirect()->route('home');
            } else {
                auth()->logout();
                return redirect()->route('staff.login')->with('error', 'These credentials do not match our records.');
            }
        } else {
            return redirect()->route('staff.login')->with('error', 'These credentials do not match our records.');
        }
    }
}
