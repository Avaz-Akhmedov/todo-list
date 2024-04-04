<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');


Route::get('/tasks/{task}/status-history', [TaskController::class, 'statusHistory'])->name('tasks.status.history');
Route::resource('/tasks', TaskController::class);