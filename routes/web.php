<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', function () {
    return view('components.layouts.app'); // Mengubah rute untuk mengarah ke app.blade.php
});
