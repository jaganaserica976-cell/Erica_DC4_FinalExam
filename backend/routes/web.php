<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\GradeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::middleware('role:Admin')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('classes', SchoolClassController::class);
        Route::resource('grades', GradeController::class);
    });

    Route::middleware('role:Teacher')->group(function () {
        Route::get('/teacher/grades', [GradeController::class, 'index'])
            ->name('teacher.grades.index');

        Route::get('/teacher/grades/create', [GradeController::class, 'create'])
            ->name('teacher.grades.create');

        Route::post('/teacher/grades', [GradeController::class, 'store'])
            ->name('teacher.grades.store');

        Route::get('/teacher/grades/{grade}/edit', [GradeController::class, 'edit'])
            ->name('teacher.grades.edit');

        Route::put('/teacher/grades/{grade}', [GradeController::class, 'update'])
            ->name('teacher.grades.update');
    });
});