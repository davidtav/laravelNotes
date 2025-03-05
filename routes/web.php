<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

//os middlewares abaixo verificam o status do usuário, para mais informações veja a pasta Middleware

Route::middleware([CheckIsNotLogged::class])->group(function(){
Route::get('/login', [AuthController::class, 'login']);
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

Route::middleware( [CheckIsLogged::class])->group(function (): void {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');

    //rota para editar uma nota
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

