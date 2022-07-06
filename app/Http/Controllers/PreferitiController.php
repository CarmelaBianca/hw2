<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session; 
use App\Models\User;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreferitiController extends BaseController
{
    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('welcome');
        return view("preferiti")->with("user", $user->username); 
    }
    public function num_ads(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $n=DB::table('addtobag')->where('username', $user->username)->count();
        return $n;
    }
    public function miei_preferiti(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $id_preferiti = DB::table('favorites')->where('username', $user->username)->get();
        if((count($id_preferiti)) !== 0){
            foreach($id_preferiti as $i){
                $ad= Ad::where('id', $i->id)->get();
                $ads[]=$ad;
            }
            return  ['response'=> $ads];
        }
        return ['response'=> false];
    }
}