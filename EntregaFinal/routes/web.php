<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing.index');
})->name('raiz');

Route::get('/login', [UserController::class, 'formularioLogin'])->name('usuario.login');
Route::post('/login', [UserController::class, 'login'])->name('usuario.validar');

Route::post('/logout', [UserController::class, 'logout'])->name('usuario.registrar');

Route::get('/users/register', [UserController::class, 'formularioNuevo'])->name('usuario.registrar');
Route::post('/users/register', [UserController::class, 'registrar'])->name('usuario.registrar');

Route::get('/backoffice', function(){
    $user = Auth::user();
    if($user ==NULL){
        return redirect()->route('usuario.login')->withErrors(['message' => 'No existe una sesión activa']);
    }
    return view('backoffice.dashboard', ['user' => $user]);
})->name('usuario.registrar');
