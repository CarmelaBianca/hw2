<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session; 
use App\Models\User;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreaController extends BaseController
{
    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('welcome');
        return view("crea")->with("user", $user->username); //lo posso usare su home blade scrivendo {{ $user }}
    }
    public function num_ads(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $n=DB::table('addtobag')->where('username', $user->username)->count();
        return $n;
    }
    public function searchImg($articolo){
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://pixabay.com/api/?key='.env('API_KEY').'&q='.$articolo.'&lang=it&per_page=3&image_type=photo&safesearch=true');
        curl_setopt($ch, CURLOPT_POST, 0); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch); 
        $json = json_decode($result, true);
        curl_close($ch); 
        return $json;
    }
    public function crea_annuncio($nome, $descrizione, $prezzo, $img){
        $session_id = session('user_id');
        $user = User::find($session_id);

        $url = str_replace("----","/", $img);
        
        $newAd =  Ad::create([
            'username' => $user->username,
            'nome' => $nome,
            'descrizione' => $descrizione,
            'prezzo' => $prezzo,
            'foto' => $url,       
        ]);
        if($newAd) return ['ok' => true];
        else return ['ok' => false];
    }
}