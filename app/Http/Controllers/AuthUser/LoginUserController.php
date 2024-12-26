<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginUserController extends Controller
{
    public function index() {
        return view("AuthUser/login");
    }

    public function login(Request $req) {
        $this->validate($req,[
            'email'     => 'required|min:3|email|max:60',
            'password'  => 'required|min:6|max:60',
        ]);

        $credentials = $req->only('email', 'password');
        //attempt to login
        if (Auth::attempt($credentials)) {
            //regenerate session
            $req->session()->regenerate();
            //redirect route dashboard
            // return to_route('creative');
            return redirect()->route('/');
        }

        //if login fails
        return back()->withErrors([
            'email' => 'Sign-in failed, please check your email or password.',
        ]);
    }
}