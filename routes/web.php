<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Backend\ChangePassword;
use App\Http\Livewire\Backend\Permission;
use App\Http\Livewire\Backend\Role;
use App\Http\Livewire\Backend\User;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Transaction;
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

Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/change-password', ChangePassword::class)->name('change-password');
    Route::get('/logout', Logout::class)->name('logout');

    Route::get('/transaction', Transaction::class)->name('transaction');

    Route::get('/users', User::class)->name('users');
    Route::get('/roles', Role::class)->name('roles');
    Route::get('/permissions', Permission::class)->name('permissions');

});

Route::middleware('guest')->group(function() {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

