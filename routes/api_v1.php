<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/test', function () {
//    $lecture = \App\Models\Lecture::query()->where('id', 8)->first();
//
//    print_r($lecture->classrooms);
//});

//Студенты
Route::prefix('students')->group(function () {
    Route::get('/', [\App\Http\Controllers\API\V1\StudentController::class, 'index'])->name('students');;
    Route::get('/{student}', [\App\Http\Controllers\API\V1\StudentController::class, 'show'])->name('students.show');
    Route::put('/{student}/update', [\App\Http\Controllers\API\V1\StudentController::class, 'update'])->name('students.update');
    Route::post('/create', [\App\Http\Controllers\API\V1\StudentController::class, 'store'])->name('students.store');
    Route::delete('/{student}/delete', [\App\Http\Controllers\API\V1\StudentController::class, 'delete'])->name('students.delete');
});


//Классы
Route::prefix('classrooms')->group(function () {
    Route::get('/', [\App\Http\Controllers\API\V1\ClassroomController::class, 'index'])->name('classrooms');
    Route::get('/{classroom}', [\App\Http\Controllers\API\V1\ClassroomController::class, 'show'])->name('classroom.show');
    Route::put('/{classroom}/update', [\App\Http\Controllers\API\V1\ClassroomController::class, 'update'])->name('classroom.update');
    Route::post('/create', [\App\Http\Controllers\API\V1\ClassroomController::class, 'store'])->name('classroom.store');
    Route::delete('/{classroom}/delete', [\App\Http\Controllers\API\V1\ClassroomController::class, 'delete'])->name('classroom.delete');

    // Учебный план
    Route::get('/{classroom}/syllabus', [\App\Http\Controllers\API\V1\SyllabusController::class, 'getSyllabus'])->name('classroom.syllabus');
    Route::post('/{classroom}/syllabus/add/lecture/{lecture}', [\App\Http\Controllers\API\V1\SyllabusController::class, 'addLectureToTheSyllabus'])->name('classroom.syllabus.add.lecture');
    Route::put('/{classroom}/syllabus/update/lecture/{lecture}', [\App\Http\Controllers\API\V1\SyllabusController::class, 'updateLectureToTheSyllabus'])->name('classroom.syllabus.update');
});

//Лекции
Route::prefix('lectures')->group(function () {
    Route::get('/', [\App\Http\Controllers\API\V1\LectureController::class, 'index'])->name('lectures');
    Route::get('/{lecture}', [\App\Http\Controllers\API\V1\LectureController::class, 'show'])->name('lectures.show');
    Route::put('/{lecture}/update', [\App\Http\Controllers\API\V1\LectureController::class, 'update'])->name('lectures.update');
    Route::post('/create', [\App\Http\Controllers\API\V1\LectureController::class, 'store'])->name('lectures.store');
    Route::delete('/{lecture}/delete', [\App\Http\Controllers\API\V1\LectureController::class, 'delete'])->name('lectures.delete');
});
