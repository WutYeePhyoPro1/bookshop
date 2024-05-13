<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/select2', function () {
    return view('layouts.select2');
});



Route::get('/', function () {
    return redirect('admins/login');

});



Route::get('/home', function () {
    return redirect()->route('admins.home');
});
