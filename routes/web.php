<?php

use App\Http\Controllers\grades\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\stages\StageCotroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//url : learnschool/dashboard/grades
// name : dash.grade.index
Route::prefix('SchoolProject/')->group(function () {
    Route::prefix('dashboard/')->name('dash.')->group(function () {
        Route::prefix('grades/')->controller(GradeController::class)->name('grade.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::get('/create', 'create')->name('create');
            Route::post('/add', 'add')->name('add');
        });
    });
});











Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
