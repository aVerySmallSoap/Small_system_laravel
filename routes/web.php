<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\NoteController;
use App\Http\Middleware\admin;
use App\Http\Middleware\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(user::class)->group(function (){
    Route::get('/note/{id}', [NoteController::class, 'note']);
    Route::get('/notes', [NoteController::class, 'collection']);
    Route::post('/list/insert', [NoteController::class, 'addHeader']);
    Route::post('/note/update/header', [NoteController::class, 'editHeader']);
    Route::post('/note/update/item', [NoteController::class, 'editNote']);
    Route::post('/note/insert', [NoteController::class, 'addNote']);
    Route::post('/note/done', [NoteController::class, 'tick']);
    Route::post('/list/archive', [NoteController::class, 'archive']);
    Route::get('/logout', function (){
       Auth::logout();
    });

    Route::middleware(admin::class)->group(function (){
        Route::get('/archives/{page}', [ArchiveController::class, 'fetch']);
        Route::post('/note/clear', [NoteController::class, 'clear']);
    });
});

Route::get('/login', [AuthenticationController::class, 'fetchLog']);
Route::get('/register', [AuthenticationController::class, 'fetchReg']);
Route::post('/auth/login', [AuthenticationController::class, 'login']);
Route::post('/auth/register', [AuthenticationController::class, 'register']);
Route::get('/', function () {return view('index');});

