<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
      'first_title' => ['max:10'],
      'first_name' => ['required', 'string', 'max:50'],
      'last_name' => ['required', 'string', 'max:50'],
      'last_title' => ['max:10'],
      'gender' => ['required', 'string'],
      'institution' => ['required', 'string', 'max:50'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'roles' => ['required'],
      'address' => ['required', 'string'],
      'phone' => ['required', 'string', 'max:20', 'unique:users'],
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
    $data['unique_id'] = Str::random(10);
    $registered = User::create([
      'unique_id' => $data['unique_id'],
      'first_title' => $data['first_title'] . '. ',
      'last_title' => $data['last_title'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'gender' => $data['gender'],
      'institution' => $data['institution'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'address' => $data['address'],
      'password' => Hash::make($data['password']),
      'status' => 1
    ]);

    $registered->assignRole($data['roles']);

    return $registered;
  }
}
