<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session; 
use App\Models\User;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnunciController extends BaseController
{
    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('welcome');
        return view("annunci")->with("user", $user->username); 
    }
    public function num_ads(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $n=DB::table('addtobag')->where('username', $user->username)->count();
        return $n;
    }
    public function miei_annunci(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $ads = Ad::where('username', $user->username)->get();
        if((count($ads)) !== 0) return ['response'=> $ads];
        else return ['response'=> false];
    }
    public function delete_ad($id){
        $delete = Ad::where('id', $id)->delete();
        return ['ok'=> $delete ? true : false];
    }
}