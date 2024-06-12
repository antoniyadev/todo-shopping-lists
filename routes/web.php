<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\ShoppingList;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('shopping-lists', 'shopping-lists.index')
    ->middleware(['auth'])
    ->name('shopping-lists.index');

Route::view('shopping-lists/create', 'shopping-lists.create')
    ->middleware(['auth'])
    ->name('shopping-lists.create');

Volt::route('shopping-lists/{list}/edit', 'shopping-lists.edit')
    ->middleware('auth')
    ->name('shopping-lists.edit');

Volt::route('shopping-lists/{list}', 'shopping-lists.view')
    ->middleware('auth')
    ->name('shopping-lists.view');

require __DIR__ . '/auth.php';
