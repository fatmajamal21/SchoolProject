<?php

use App\Http\Controllers\grades\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\section\SectionController;
use App\Http\Controllers\stages\StageCotroller;
use App\Http\Controllers\Teachers\teacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
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
            Route::get('/getactive', 'getactive')->name('getactive');
            Route::get('/getactivesection', 'getactivesection')->name('getactivesection');
            Route::get('/getactivestage', 'getactivestage')->name('getactivestage');
            Route::post('/add', 'add')->name('add');
            Route::post('/addsection', 'addsection')->name('addsection');
            Route::post('/changemaster', 'changemaster')->name('changemaster');
        });


        Route::prefix('sections/')->controller(SectionController::class)->name('section.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::post('/add', 'add')->name('add');
            Route::post('/changestatus', 'changestatus')->name('changestatus');
            Route::post('/changestatus2', 'changestatus2')->name('changestatus2');
        });

        Route::prefix('teachers/')->controller(teacherController::class)->name('teacher.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::post('/add', 'add')->name('add');
            Route::post('/update', 'update')->name('update');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/active1', 'active1')->name('active1');
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
