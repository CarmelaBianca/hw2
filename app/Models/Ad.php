<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model {

    protected $table = 'ads';
    protected $autoincrement = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'username', 'nome', 'descrizione', 'prezzo', 'foto'
    ];

    public function user() {
        return $this->belongsTo("App\Models\User","username");
    }
    public function favorites() {
        return $this->belongsToMany("App\Models\User", "favorites", "id", "username")->as('favorites'); //as perchè altrimenti si chiama pivot
    }
    public function addtobag() {
        return $this->belongsToMany("App\Models\User", "addtobag", "id", "username")->as('addtobag'); 
    }
}


?>