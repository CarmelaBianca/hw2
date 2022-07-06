<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'nome', 'cognome', 'email', 'data_di_nascita', 'username', 'password'
    ];
    protected $primaryKey = 'username';
    protected $autoIncrement = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function ads() {
        return $this->hasMany("App\Models\Ad");
    }
    public function favorites() {
        return $this->belongsToMany("App\Models\Ad", "favorites", "username", "id")->as('favorites');
    }
    public function addtobag() {
        return $this->belongsToMany("App\Models\Ad", "addtobag", "username", "id")->as('addtobag');
    }

}
