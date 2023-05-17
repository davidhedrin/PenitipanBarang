<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\LoginComponent;
use App\Http\Livewire\LogoutComponent;
use App\Http\Livewire\RegisterComponent;

//Admin
use App\Http\Livewire\Admin\DashboardComponent as DashboardAdmin;
use App\Http\Livewire\Admin\UsersComponent;
use App\Http\Livewire\Admin\SliderComponent;

//Client
use App\Http\Livewire\Client\HomeComponent as DashboardClient;
use App\Http\Livewire\Client\FormPenitipanComponent;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', DashboardClient::class)->name('home');
Route::get('/login', LoginComponent::class)->name('login');
Route::get('/logout', LogoutComponent::class)->name('logout');
Route::get('/register', RegisterComponent::class)->name('register');

Route::middleware(['auth:sanctum', 'adminrole'])->group(function () {
    Route::get('/dashboard', DashboardAdmin::class)->name('admin-dashboard');
    Route::get('/all-users', UsersComponent::class)->name('all-users');
    Route::get('/all-sliders', SliderComponent::class)->name('all-sliders');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/form-penitipan', FormPenitipanComponent::class)->name('form-penitipan');
});