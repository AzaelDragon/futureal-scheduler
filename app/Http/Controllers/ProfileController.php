<?php

namespace App\Http\Controllers;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this -> middleware('auth');

    }

    /**
     * Show the profile page..
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        return response(view('profile'));

    }

    public function updateName(Request $request) {

        $rules = array(
            'name' => 'required',
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $room = User::find(Auth::user() -> id);
        $room -> name = $request -> input('name');
        $room -> save();

        return response('OK', 200);

    }

    public function updateEmail(Request $request) {

        $rules = array(
            'email' => 'required|email',
            'confirmEmail' => 'required|email',
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $email = $request -> input('email');
        $emailConfirmation = $request -> input('confirmEmail');

        if ($email != $emailConfirmation) {
            return response('NOMATCH', 400);
        }

        $user = User::find(Auth::user() -> id);
        $user -> email = $request -> input('email');
        $user -> save();

        return response('OK', 200);

    }

    public function updatePassword(Request $request) {

        $rules = array(
            'currentPassword' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required'
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $password = $request -> input('password');
        $confirmPassword = $request -> input('confirmPassword');

        if ($password != $confirmPassword) {
            return response('NOMATCH', 400);
        }

        $user = User::find(Auth::user() -> id);

        $currentPassword = $request -> input('currentPassword');

        if (!Hash::check($currentPassword, $user -> password)) {
            return response('WRONGPASSWORD', 400);
        }

        $hashedPassword = Hash::make($password);

        $user -> password = $hashedPassword;
        $user -> save();

        return response('OK', 200);

    }

}
