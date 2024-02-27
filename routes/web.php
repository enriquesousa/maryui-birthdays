<?php

use Illuminate\Support\Facades\Route;

use Livewire\Volt\Volt;
use App\Livewire\Counter;
use App\Livewire\ShowPosts;

// Volt::route('/', 'users.index');

Route::get('/', ShowPosts::class);

Route::get('/counter', Counter::class);
// Route::get('/show-posts', ShowPosts::class);