<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($request->isMobile) {
            $user = User::where('email', $input["email"])->first();
            $userProfile = UserProfile::where('user_id', $user->id)->first();

            if (!$user || !Hash::check($input['password'], $user->password)) {
                return response([
                    'message' => 'Bad credentials'
                ], 401);
            }

            $token = $user->createToken('myAppToken')->plainTextToken;

            $response = [
                'user' => $user,
                'user_profile' => $userProfile,
                'token' => $token,
            ];

            return response($response, 201);
        } else {
            if (auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {
                $user = auth()->user();
                if ($user->user_role == 2) {
                    return redirect()->route('home');
                } else {
                    auth()->logout();
                    return redirect()->route('login')->with('error', 'These credentials do not match our records.');
                }
            } else {
                return redirect()->route('login')->with('error', 'These credentials do not match our records.');
            }
        }
    }
}
