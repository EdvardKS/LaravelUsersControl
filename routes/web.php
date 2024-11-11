<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            

// Ruta principal redirige a la vista welcome
Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');

Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

// Rutas protegidas por autenticación
Route::group(['middleware' => 'auth'], function () {
    // Redirige /dashboard y /panel a la vista del dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/panel', [HomeController::class, 'index'])->name('panel');

    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');

    // Rutas de perfil de usuario
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'updateAdmin'])->name('profile.update');
	
	Route::get('user-management', [UserProfileController::class, 'controlUsers'])->name('user-management');
	Route::get('user-edit/{id}', [UserProfileController::class, 'edit'])->name('user-edit');
	Route::put('user-update/{id}', [UserProfileController::class, 'update'])->name('user-update');
	
	// Rutas de autenticación y registro
	Route::get('/register', [RegisterController::class, 'create'])->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');

	// Eliminar definitavamente un usuario de BD:
	Route::delete('/user-delete/{id}', [UserProfileController::class, 'destroy'])->name('user-delete');

    
    // Páginas estáticas
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');

    // Ruta dinámica para páginas adicionales
    Route::get('/{page}', [PageController::class, 'index'])->name('page');

    // Ruta de logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
