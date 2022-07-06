<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session; 
use App\Models\User;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('welcome');
        return view("home")->with("user", $user->username); //lo posso usare su home blade scrivendo {{ $user }}
    }
    public function num_ads(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $n=DB::table('addtobag')->where('username', $user->username)->count();
        return $n;
    }
    public function annunci_home() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        $annunci = Ad::where('username', '<>', $user->username)->get();
        return $annunci;
    }
    
    public function presente_pref($id, $indice) {
        $session_id = session('user_id');
        $user = User::find($session_id);

        $exist=DB::table('favorites')->where('username', $user->username)->where('id', $id)->exists();
        $favorites = array(
            "preferito" =>  $exist ? true : false,
            "indice" => $indice
        );
        return $favorites;

    }
    public function aggiungi_pref($id, $action){
        $session_id = session('user_id');
        $user = User::find($session_id);

        if($action=='add')
            $ok=$user->favorites()->attach($id);
        else
            $ok=$user->favorites()->detach($id); 
        return ['ok'=> $ok];    
    }   
    public function aggiungi_carrello($id) {
        $session_id = session('user_id');
        $user = User::find($session_id);
        $exist=DB::table('addtobag')->where('username', $user->username)->where('id', $id)->exists();
        if(!$exist){
            $user->addtobag()->attach($id);
            return ['ok'=> true];
        }else  return ['ok'=> false];
             
    }
    
    public function cerca_articoli($articolo) {
        $session_id = session('user_id');
        $user = User::find($session_id);
        $annunci = Ad::where('nome', $articolo)->where('username', '<>', $user->username)->get();
        return $annunci;
    }
}