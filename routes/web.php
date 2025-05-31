<?php

use App\Http\Controllers\grades\GradeController;
use App\Http\Controllers\lectuer\LectuerController;
use App\Http\Controllers\mean\meancontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\section\SectionController;
use App\Http\Controllers\stages\StageCotroller;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subject\SubjectController;
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
        //middleware('admin')->
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
        //middleware('teacher')->
        Route::prefix('teachers/')->controller(teacherController::class)->name('teacher.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::post('/add', 'add')->name('add');
            Route::post('/update', 'update')->name('update');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/active1', 'active1')->name('active1');
        });
        Route::prefix('lectuers/')->controller(LectuerController::class)->name('lectuers.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::post('/add', 'add')->name('add');
            Route::post('/update', 'update')->name('update');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/active1', 'active1')->name('active1');
        });
        Route::prefix('subject')->controller(SubjectController::class)->name('subject.')->group(function () {
            Route::get('/', 'index')->name('index');           // dash.subject.index
            Route::get('/getdata', 'getData')->name('getdata'); // dash.subject.getdata
            Route::get('/getdata/lectuers', 'getDataLectuers')->name('getdata.lectuers');

            Route::get('/download/{filename}', 'download')->name('download'); // dash.subject.getdata
            Route::get('/lectuers/{id}', 'lectuers')->name('lectuers'); // dash.subject.lectuers

            Route::post('/add', 'add')->name('add');             // dash.subject.add
            Route::post('/update', 'update')->name('update');    // dash.subject.update
            Route::post('/delete', 'delete')->name('delete');    // dash.subject.delete
            Route::post('/activate', 'activate')->name('activate'); // dash.subject.activate
        });
        Route::prefix('students')->controller(StudentController::class)->name('student.')->group(function () {
            Route::get('/', 'index')->name('index');           // dash.subject.index
            Route::get('/getdata', 'getData')->name('getdata'); // dash.subject.getdata
            Route::get('/getdata/lectuers', 'getDataLectuers')->name('getdata.lectuers');

            Route::get('/download/{filename}', 'download')->name('download'); // dash.subject.getdata
            Route::get('/lectuers/{id}', 'lectuers')->name('lectuers'); // dash.subject.lectuers

            Route::post('/add', 'add')->name('add');             // dash.subject.add
            Route::post('/update', 'update')->name('update');    // dash.subject.update
            Route::post('/delete', 'delete')->name('delete');    // dash.subject.delete
            Route::post('/activate', 'activate')->name('activate'); // dash.subject.activate
        });
        Route::prefix('mean')->controller(meancontroller::class)->name('mean.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
        // Route::middleware(['auth', 'teacher'])->group(function () {
        //     // المسارات التي يحق للمعلمين الوصول إليها
        //     Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
        // });

        // Route::middleware(['auth', 'admin'])->group(function () {
        //     // المسارات الخاصة بالأدمن فقط
        //     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // });

        // Route::middleware(['auth', 'student'])->group(function () {
        //     // المسارات الخاصة بالطلاب فقط
        //     Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
        // });
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
