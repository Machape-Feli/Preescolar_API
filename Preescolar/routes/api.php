<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssignatureController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\InstalationController;
use App\Http\Controllers\RelativeController;
use App\Http\Controllers\StudentContactController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware(['conexion.db'])->group(function () {
    //Route::post('/login', [UserAuthController::class, 'login'])->name('login');
    //Route::post('/register', [UserAuthController::class, 'store'])->name('register');

    //Route::middleware('auth:sanctum')->group(function () {
        //Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

    //Clases rutas
        Route::get('/clases', [AssignatureController::class, 'index'])->name('clases.index');
        Route::post('/clases', [AssignatureController::class, 'store'])->name('clases.store');
        //Route::get('/clases/{id}', [AssignatureController::class, 'show'])->name('clases.show'); falta verificar!
        //Route::put('/clases/{id}', [AssignatureController::class, 'update'])->name('clases.update'); falta verificar!
        //Route::delete('/clases/{id}', [AssignatureController::class, 'destroy'])->name('clases.destroy'); falta verificar!
    
    //Asistencia rutas
        Route::get('/asistencias', [AttendanceController::class, 'index'])->name('asistencias.index');
        Route::post('/asistencias', [AttendanceController::class, 'store'])->name('asistencias.store');
        //Route::get('/clases/{id}', [AssignatureController::class, 'show'])->name('clases.show'); falta verificar!
        //Route::put('/clases/{id}', [AssignatureController::class, 'update'])->name('clases.update'); falta verificar!
        //Route::delete('/clases/{id}', [AssignatureController::class, 'destroy'])->name('clases.destroy'); falta verificar!

    //Instalaciones rutas
        Route::get('/instalaciones', [InstalationController::class, 'index'])->name('instalaciones.index');
        Route::post('/instalaciones', [InstalationController::class, 'store'])->name('instalaciones.store');
        Route::get('/instalaciones/{instalacion}', [InstalationController::class, 'show'])->name('instalaciones.show');
        Route::put('/instalaciones/{instalacion}', [InstalationController::class, 'update'])->name('instalaciones.update'); //try
        Route::delete('/instalaciones/{instalacion}', [InstalationController::class, 'destroy'])->name('instalaciones.destroy');

    //Estudiantes rutas
        Route::get('/estudiantes', [StudentController::class, 'index'])->name('estudiantes.index');
        Route::post('/estudiantes', [StudentController::class, 'store'])->name('estudiantes.store');
        //Route::get('/estudiantes/{id}', [StudentController::class, 'show'])->name('estudiantes.show');  falta verificar!
        //Route::put('/estudiantes/{id}', [StudentController::class, 'update'])->name('estudiantes.update');  falta verificar!
        //Route::delete('/estudiantes/{id}', [StudentController::class, 'destroy'])->name('estudiantes.destroy');  falta verificar!

    //Familiares con auth
        Route::get('/familiares', [RelativeController::class, 'index'])->name('familiares.index');
        Route::post('/familiares', [RelativeController::class, 'store'])->name('familiares.store');
        Route::get('/familiares/{familiar}', [RelativeController::class, 'show'])->name('familiares.show');
        Route::put('/familiares/{familiar}', [RelativeController::class, 'update'])->name('familiares.update');
        Route::delete('/familiares/{relative}', [RelativeController::class, 'destroy'])->name('familiares.destroy');

        //Instructores con auth
        Route::get('/instructores', [TeacherController::class, 'index'])->name('instructores.index');
        Route::post('/instructores', [TeacherController::class, 'store'])->name('instructores.store');
        Route::get('/instructores/{id}', [TeacherController::class, 'show'])->name('instructores.show');
        Route::put('/instructores/{id}', [TeacherController::class, 'update'])->name('instructores.update');
        Route::delete('/instructores/{id}', [TeacherController::class, 'destroy'])->name('instructores.destroy');

        //UserAuth
        Route::get('/UserAuth', [UserAuthController::class, 'index']);
        Route::post('/UserAuth', [UserAuthController::class, 'store']);
        Route::post('/login', [UserAuthController::class, 'login']);
        Route::put('/UserAuth/{id}', [UserAuthController::class, 'update']);
        Route::delete('/UserAuth/{id}', [UserAuthController::class, 'destroy']);
        Route::post('/UserAuthLogin', [UserAuthController::class, 'login']);

    
    //});
//});

/*
Route::(get/post/put/delete/etc)("nombre", [nombreController::(funcionController)])
*/


