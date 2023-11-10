<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property  \App\Models\Student  $resource*/

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'classroom' => $this->when($request->routeIs('students.show'), $this->resource->classroom?->name),
            'lectures' => $this->when($request->routeIs('students.show'), LectureResource::collection($this->resource->classroom?->lectures)),
        ];
    }
}
