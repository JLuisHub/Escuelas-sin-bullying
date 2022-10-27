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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/verAlumnos', function () {
    return view('verAlumnos');
});
// rutas para las vistas
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('docentes','App\Http\Controllers\DocentesController');
Route::resource('estudiantes','App\Http\Controllers\EstudiantesController');

// Ruta para mostrar la pagina de registro al tutor legal
Route::get('/tutor_legal/register_view', function(){
    return view('TutorLegal.registro');
});
Route::resource('estudiantes','App\Http\Controllers\EstudiantesController');
