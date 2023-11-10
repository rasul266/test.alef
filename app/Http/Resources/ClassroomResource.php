<?php

namespace App\Http\Resources;

use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'students' => $this->when($request->routeIs('classroom.show'), StudentResource::collection($this->resource->students)),
            'lectures' => $this->when($request->routeIs('classroom.lectures'), LectureResource::collection($this->resource->lectures)),
        ];
    }
}
