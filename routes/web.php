<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/note/{id}', [NoteController::class, 'note']);
Route::get('/notes', [NoteController::class, 'collection']);
Route::post('/list/insert', [NoteController::class, 'addHeader']);
Route::post('/note/update/header', [NoteController::class, 'editHeader']);
Route::post('/note/update/item', [NoteController::class, 'editNote']);
Route::post('/note/insert', [NoteController::class, 'addNote']);
Route::post('/list/archive', [NoteController::class, 'archive']);
Route::get('/archives', [ArchiveController::class, 'fetch']);
