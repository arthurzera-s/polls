<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app.home');
})->name('home');


Route::get('/todas-enquetes', function (){
    return view('app.todas-enquetes');
});

Route::get('/criar-enquete', function (){
    return view('app.criar-enquete');
});

Route::get('/enquete/{id}', function (){
    return view('app.enquete');
});

