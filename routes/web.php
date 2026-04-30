<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->group([], function() {
Route::group([], function () {
    Route::livewire('/', 'pages::main');

    Route::prefix('/songs')->group(function () {
        Route::livewire('/', 'pages::songs.search');
        Route::livewire('/create', 'pages::songs.view');
        Route::livewire('/{song}', 'pages::songs.view');
    });

    Route::prefix('/performances')->group(function () {
        Route::livewire('/', 'pages::performances.search');
        Route::livewire('/{performance}', 'pages::performances.view');
    });

});

Route::livewire("/login", 'pages::login');
