<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session; 
use App\Models\User;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarrelloController extends BaseController
{
    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('welcome');
        return view("carrello")->with("user", $user->username); 
    }
    
    public function carrello(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $id_ads = DB::table('addtobag')->where('username', $user->username)->get();
        if((count($id_ads)) !== 0){
            foreach($id_ads as $i){
                $ad= Ad::where('id', $i->id)->get();
                $ads[]=$ad;
            }
            return ['response'=> $ads];
        }
        return ['response'=> false];
    }
    public function remove($id){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $ok=$user->addtobag()->detach($id); 
        return ['ok'=> $ok ? true : false];
    }
    public function acquista(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $id_ads = DB::table('addtobag')->where('username', $user->username)->get();
        foreach($id_ads as $i){
            $ad= Ad::where('id', $i->id)->delete();
            if(!$ad) return ['ok'=> false];
        }
        return ['ok'=> true];
    }
}