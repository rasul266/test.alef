<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LectureResource;
use App\Models\Classroom;
use App\Models\Lecture;
use App\Services\SyllabusService;
use App\Traits\HasHttpResponse;
use Illuminate\Http\Request;


class SyllabusController extends Controller
{
    use HasHttpResponse;
    protected SyllabusService $service;

    public function __construct(SyllabusService $service)
    {
        $this->service = $service;
    }

    public function getSyllabus(Classroom $classroom) //Получение учебного плана для определенного класса
    {
        $syllabus = $classroom->lectures;

        return $this->success(
            message: 'Учебный план для класса - ' . $classroom->name,
            data: LectureResource::collection($syllabus)
                ->resolve()
        );
    }

    public function addLectureToTheSyllabus(Request $request, Classroom $classroom, Lecture $lecture) //Добавление лекции в Учебный план
    {
        $position = $request->input('position');

        if ($this->service->checkExistLectureInSyllabus($classroom, $lecture)) {
            return $this->error('В учебном плане уже существует такая лекция');
        }

        if ($this->service->checkExistLectureForThisPosition($classroom, $position)) {
            return $this->error('В учебном плане на этой позиции уже существует лекция');
        }

        $classroom->lectures()->attach($lecture, ['position'=>$position]);

        return $this->success(
            message: 'Учебный план для класса - ' . $classroom->name,
            data: LectureResource::collection($classroom->lectures)->resolve()
        );
    }

    public function updateLectureToTheSyllabus(Request $request, Classroom $classroom, Lecture $lecture) //Обновление лекции в Учебный план
    {
        $position = $request->input('position');

        if (!$this->service->checkExistLectureInSyllabus($classroom, $lecture)) {
            return $this->error('Для обновления учебный план не найден');
        }

        if ($this->service->checkExistLectureForThisPosition($classroom, $position)) {
            return $this->error('В учебном плане на этой позиции уже существует лекция');
        }

        $classroom->lectures()->updateExistingPivot($lecture, ['position'=>$position]);

        return $this->success(
            message: 'Учебный план обновлен для класса - ' . $classroom->name,
            data: LectureResource::collection($classroom->lectures)->resolve()
        );
    }


}