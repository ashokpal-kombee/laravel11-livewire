<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\{Counter, Login, Register, Dashboard, Logout, BlogComponents, ComputedComponents, RequestBunding, TaskManager, UserTable};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/counter', Counter::class);

//Auth Route
Route::get('/login', Login::class);
Route::get('/register', Register::class);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/logout', Logout::class)->name('logout');

    //Blog Module
    Route::get('/blog', BlogComponents::class)->name('blog');

    //Computed Components
    Route::get('/computed', ComputedComponents::class)->name('computed');

    //Request Bunding
    Route::get('/request-bunding', RequestBunding::class)->name('request-bunding');

    //Nesting
    Route::get('/nesting', TaskManager::class)->name('nesting');

    //Powergride
    Route::get('/user-list', UserTable::class)->name('user-list');
});
