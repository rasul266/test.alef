<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\StudentController;
use App\Http\Controllers\API\V1\ClassroomController;
use App\Http\Controllers\API\V1\LectureController;
use App\Http\Controllers\API\V1\SyllabusController;

//Студенты
Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students');;
    Route::get('/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::put('/{student}/update', [StudentController::class, 'update'])->name('students.update');
    Route::post('/create', [StudentController::class, 'store'])->name('students.store');
    Route::delete('/{student}/delete', [StudentController::class, 'delete'])->name('students.delete');
});

//Классы
Route::prefix('classrooms')->group(function () {
    Route::get('/', [ClassroomController::class, 'index'])->name('classrooms');
    Route::get('/{classroom}', [ClassroomController::class, 'show'])->name('classroom.show');
    Route::put('/{classroom}/update', [ClassroomController::class, 'update'])->name('classroom.update');
    Route::post('/create', [ClassroomController::class, 'store'])->name('classroom.store');
    Route::delete('/{classroom}/delete', [ClassroomController::class, 'delete'])->name('classroom.delete');

    // Учебный план
    Route::get('/{classroom}/syllabus', [SyllabusController::class, 'getSyllabus'])->name('classroom.syllabus');
    Route::post('/{classroom}/syllabus/add/lecture/{lecture}', [SyllabusController::class, 'addLectureToTheSyllabus'])->name('classroom.syllabus.add.lecture');
    Route::put('/{classroom}/syllabus/update/lecture/{lecture}', [SyllabusController::class, 'updateLectureToTheSyllabus'])->name('classroom.syllabus.update');
});

//Лекции
Route::prefix('lectures')->group(function () {
    Route::get('/', [LectureController::class, 'index'])->name('lectures');
    Route::get('/{lecture}', [LectureController::class, 'show'])->name('lectures.show');
    Route::put('/{lecture}/update', [LectureController::class, 'update'])->name('lectures.update');
    Route::post('/create', [LectureController::class, 'store'])->name('lectures.store');
    Route::delete('/{lecture}/delete', [LectureController::class, 'delete'])->name('lectures.delete');
});
