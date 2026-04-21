<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->group([], function() {
Route::group([], function() {
    Route::livewire('/', 'pages::main');
    Route::livewire('/songs/search', 'pages::songs.search');
    Route::livewire('/songs/create', 'pages::songs.create');
    Route::livewire('/songs/{song}', 'pages::songs.view');
});

Route::livewire("/login", 'pages::login');
