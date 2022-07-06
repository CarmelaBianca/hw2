<?php

use Illuminate\Support\Facades\Route;

Route::get("welcome", "WelcomeController@index");

Route::get('register','RegisterController@register_form');
Route::post('register','RegisterController@do_register');

Route::get("register/username/{username}", "RegisterController@checkUsername");
Route::get("register/email/{email}", "RegisterController@checkEmail");
Route::get("register/password/{password}", "RegisterController@checkPassword");

Route::get("login", "LoginController@login")->name("login");
Route::post("login", "LoginController@checkLogin");
Route::get("logout", "LoginController@logout")->name("logout");

Route::get("home", "HomeController@index");
Route::get("num_ads_home", "HomeController@num_ads");
Route::get("ads", "HomeController@annunci_home");
Route::get("home/id/{id}/indice/{i}", "HomeController@presente_pref");
Route::get("home/id/{id}/action/{action}", "HomeController@aggiungi_pref"); 
Route::get("home/id/{id}", "HomeController@aggiungi_carrello");
Route::get("home/articolo/{articolo_cercato}", "HomeController@cerca_articoli");

Route::get("crea", "CreaController@index");
Route::get("num_ads_crea", "CreaController@num_ads");
Route::get("crea/articolo/{articolo}", "CreaController@searchImg");
Route::get("crea/nome/{nome}/descrizione/{descrizione}/prezzo/{prezzo}/foto/{img}", "CreaController@crea_annuncio");

Route::get("annunci", "AnnunciController@index");
Route::get("num_ads_annunci", "AnnunciController@num_ads");
Route::get("miei_annunci", "AnnunciController@miei_annunci");
Route::get("miei_annunci/id/{id}", "AnnunciController@delete_ad");

Route::get("preferiti", "PreferitiController@index");
Route::get("num_ads_preferiti", "PreferitiController@num_ads");
Route::get("miei_preferiti", "PreferitiController@miei_preferiti");

Route::get("carrello", "CarrelloController@index");
Route::get("mio_carrello", "CarrelloController@carrello");
Route::get("mio_carrello/id/{id}", "CarrelloController@remove");
Route::get("acquista", "CarrelloController@acquista");
