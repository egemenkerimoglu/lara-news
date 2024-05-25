<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('add', function(){
    User::create([
        'name'=>'Deneme2',
        'email'=>'deneme2@deneme.com',
        'password'=> Hash::make('102030Elkom.'),
    ]);
    return "Ekledi";
});
