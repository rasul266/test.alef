<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentSaveRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Traits\HasHttpResponse;

class StudentController extends Controller
{
    use HasHttpResponse;

    //
    public function index() // Получение всех студентов
    {
        $students = Student::query()->latest()->get();

        return $this->success(
            message: 'Студенты',
            data: StudentResource::collection($students)->resolve(),
        );
    }

    public function show(Student $student) // Получение одного студента
    {
        return $this->success(
            message: 'Студент',
            data: StudentResource::make($student)
                ->resolve()
        );
    }

    public function store(StudentSaveRequest $request) // Создание студента
    {
        $student = Student::query()->create($request->validated());
        return $this->success(
            message: 'Студент создан',
            data: StudentResource::make($student)->resolve()
        );
    }

    public function update(StudentSaveRequest $request, Student $student) // Обновление студента
    {
        $student->update($request->validated());

        return $this->success(
            message: 'Студент обновлен',
            data: StudentResource::make($student)->resolve()
        );
    }

    public function delete(Student $student) // Удаление студента
    {
        $student->delete();
        return $this->successWithoutData();
    }

}
