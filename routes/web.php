<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;


Route::group([], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/login', fn() => view("pages.login"))->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    Route::get('/setup-password', fn() => view("pages.setup-password"))->name('reset-password');
    Route::post('/setup-password', [AuthController::class, 'setupNewPassword']);
});


Route::middleware('auth')->group(function () {
    Route::get('/', fn()=> redirect()->route('songs.index'));

    Route::livewire('/songs', 'pages::songs.search')->name('songs.index');
    Route::livewire('/songs/create', 'pages::songs.view')->name('songs.create');
    Route::livewire('/songs/{song}', 'pages::songs.view')->name('songs.show');

    Route::livewire('/performances', 'pages::performances.search')->name('performances.index');
    Route::livewire('/performances/create', 'pages::performances.view')->name('performances.create');
    Route::livewire('/performances/{performance}', 'pages::performances.view')->name('performances.show');

    Route::livewire('/settings', 'pages::settings')->name('settings');
});
