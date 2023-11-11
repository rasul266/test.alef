<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lecture\LectureSaveRequest;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use App\Traits\HasHttpResponse;

class LectureController extends Controller
{
    use HasHttpResponse;

    public function index() // Получение всех лекций
    {
        $lectures = Lecture::query()->get();

        return $this->success(
            message: 'Лекции',
            data: LectureResource::collection($lectures)
                ->resolve()
        );
    }

    public function show(Lecture $lecture) // Получение одной лекций
    {
        return $this->success(
            message: 'Лекция',
            data: LectureResource::make($lecture)
                ->resolve()
        );
    }

    public function store(LectureSaveRequest $request) // Добавление новой лекции
    {
        $lecture = Lecture::query()->create($request->validated());
        return $this->success(
            message: 'Лекция создана',
            data: LectureResource::make($lecture)->resolve()
        );
    }

    public function update(LectureSaveRequest $request, Lecture $lecture) // Обновление лекции
    {
        $lecture->update($request->validated());

        return $this->success(
            message: 'Лекция обновлена',
            data: LectureResource::make($lecture)->resolve()
        );
    }

    public function delete(Lecture $lecture) // Удаление лекции
    {
        $lecture->delete();
        return $this->successWithoutData();
    }
}
