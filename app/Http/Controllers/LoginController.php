<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function login() {
        if(session('user_id') != null) {
            return redirect("home");
        }
        else {
            return view('login')
            ->with('csrf_token', csrf_token())->with('error');
        }
     }

    public function checkLogin() {
        $user = User::where('username', request('username'))->where('password', request('password'))->first();
        if($user !== null) {
            $error='exists';
            Session::put('user_id', $user->username);
            return redirect('home');
        }
        else {
            $error='not_exist';
            return view('login')->with('error', $error);
        }
    }

    public function logout() {
        Session::flush();
        return redirect('login');
    }
}