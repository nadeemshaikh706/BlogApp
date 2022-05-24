<?php

use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'home');

Auth::routes();
Route::middleware('auth')->group(function() {
    Route::get('blog/create', \App\Http\Livewire\BlogCreate::class)->name('blog.create');
    Route::get('blog/{slug}', \App\Http\Livewire\Blog::class);
    Route::get('blog/edit/{slug}', \App\Http\Livewire\BlogEdit::class)->name('blog.edit');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
