<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí registramos todas las rutas de la aplicación.
|--------------------------------------------------------------------------
*/

/**
 * ============================
 * RUTAS PÚBLICAS
 * ============================
 */
Route::get('/', fn () => view('users/indexgeneral'))->name('inicio');

// Vista pública de productos (ejemplo de catálogo)
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

// Ruta de productos para clientes
Route::get('/productos', [ProductoController::class, 'shop'])->name('users.productos');


/**
 * ============================
 * AUTENTICACIÓN
 * ============================
 */
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página después de login (general usuarios)
Route::get('users/indexgeneral', [AuthController::class, 'indexgeneral'])->name('indexgeneral');

/**
 * Login con Google
 */
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


/**
 * ============================
 * VERIFICACIÓN DE EMAIL
 * ============================
 */
Route::get('/email/verify', fn () => view('modules.auth.verify-email'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    Auth::login($request->user()); // logueo automático tras verificar
    return redirect()->route('admin.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Se ha reenviado el link de verificación a tu correo.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/**
 * ============================
 * RUTAS PROTEGIDAS (AUTH + VERIFIED)
 * ============================
 */
Route::middleware(['auth', 'verified'])->group(function () {

    // Vista del admin
    Route::get('/admin', [ProductoController::class, 'index'])->name('admin.index');

    // CRUD de productos dentro del área admin
    Route::resource('admin/productos', ProductoController::class)->names('productos');
});


/**
 * ============================
 * CARRITO
 * ============================
 */
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');