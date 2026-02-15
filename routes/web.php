<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return Inertia::render('Invoice');
});*/


Route::get('/', function () {
    return Inertia::render('Invoice', [
        'test' => 'HOLA',
    ]);
});