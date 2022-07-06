<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session; 
use App\Models\User;
class RegisterController extends BaseController
{
    public function register_form(){
        $error=Session::get('error');
        Session::forget('error'); 
        return view('register')->with('error', $error);
    }
    public function do_register(){
        $error=array();
        if(strlen(request('nome')) == 0 || strlen(request('cognome')) == 0 || strlen(request('email')) == 0
            && strlen(request('username')) == 0 || strlen(request('password')) == 0){
                Session::put('error','empty_fields');
                return redirect ('register')->withInput();
        }
        if(User::where('username', request('username'))->first()){
            Session::put('error','existing_user');
            return redirect ('register')->withInput();
        }
        if(User::where('email', strtolower(request('email')))->first()){
            Session::put('error','existing_email');
            return redirect ('register')->withInput();
        }

        $password = request('password');
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,50}$/', $password) || strlen($password)<8 || strlen($password)>50) {
            Session::put('error','invalid_password');
            return redirect ('register')->withInput();
        }

        if (!filter_var(strtolower(request('email')), FILTER_VALIDATE_EMAIL)) {
            Session::put('error','invalid_email');
            return redirect ('register')->withInput();
        }

        if (count($error)===0){
            $newUser =  User::create([
                'nome' => request('nome'),
                'cognome' => request('cognome'),
                'email' => request('email'),
                'data_di_nascita' => request('data_di_nascita'),
                'username' => request('username'),
                'password' => request('password'),
             
            ]);
        }
        if ($newUser) {
            Session::put('user_id', request('username'));
            return redirect('home');
        } 
    }
    public function checkUsername($username) {
        $exist = User::where('username', $username)->exists();
        return ['exists' => $exist];
    }
    public function checkEmail($email) {
        $exist = User::where('email', $email)->exists();
        return ['exists' => $exist];
    }
    public function checkPassword($password) {
        $ok=preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,50}$/', $password);
        if ($ok>0) $ok=true;
        else $ok=false;
        return ['ok' => $ok];
    }
}