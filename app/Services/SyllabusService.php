<?php

namespace App\Services;

use App\Models\Classroom;
use App\Models\Lecture;
use Illuminate\Support\Facades\DB;

class SyllabusService
{
    public function checkExistLectureInSyllabus(Classroom $classroom, Lecture $lecture) :bool
    {
        return DB::table('classroom_lecture')
            ->where('classroom_id', $classroom->id)
            ->where('lecture_id', $lecture->id)
            ->exists();
    }

    public function checkExistLectureForThisPosition(Classroom $classroom, int $position) :bool
    {
        return DB::table('classroom_lecture')
            ->where('classroom_id', $classroom->id)
            ->where('position', $position)
            ->exists();
    }
}
