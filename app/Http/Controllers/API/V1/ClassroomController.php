<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classroom\ClassroomSaveRequest;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\LectureResource;
use App\Models\Classroom;
use App\Models\Lecture;
use App\Models\Student;
use App\Services\SyllabusService;
use App\Traits\HasHttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    use HasHttpResponse;

    public function index() // Получение всех классов
    {
        $classrooms = Classroom::query()->get();

        return $this->success(
            message: 'Классы',
            data: ClassroomResource::collection($classrooms)
                ->resolve()
        );
    }

    public function show(Classroom $classroom) // Получение одного класса
    {
        return $this->success(
            message: 'Класс',
            data: ClassroomResource::make($classroom)
                ->resolve()
        );
    }

    public function store(ClassroomSaveRequest $request) // Создание класса
    {
        $data = $request->validated();
        $classroom = Classroom::query()->create($data);

        return $this->success(
            message: 'Класс создан',
            data: ClassroomResource::make($classroom)->resolve()
        );
    }

    public function update(ClassroomSaveRequest $request, Classroom $classroom) // Обновление класса
    {
        $classroom->update($request->validated());

        return $this->success(
            message: 'Студент обновлен',
            data: ClassroomResource::make($classroom)->resolve()
        );
    }


    public function delete(Classroom $classroom)// Удаление класса
    {
        $classroom->delete();
        return $this->successWithoutData();
    }
}
