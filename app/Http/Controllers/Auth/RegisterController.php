<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'middle_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'last_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'birthday' => ['required'],
            'contact_no' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', Password::min(6)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'confirm_password' => ['required', 'same:password'],
            'street' => ['required'],
            'region' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
            'barangay' => ['required'],
            'postal_code' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'user_role' => 2,
            'is_notify' => $data['is_notify'],
        ]);

        $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'middle_name' => $data['middle_name'],
            'birthday' => $data['birthday'],
            'contact_no' => $data['contact_no'],
            'street' => $data['street'],
            'region' => $data['region'],
            'province' => $data['province'],
            'city' => $data['city'],
            'barangay' => $data['barangay'],
            'postal_code' => $data['postal_code']
        ]);
        return $user;
    }
}
