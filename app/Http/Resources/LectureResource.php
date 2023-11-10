<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'topic' => $this->resource->topic,
            'description' => $this->resource->description,
            'position' => $this->when(($request->routeIs('students.show') OR $request->routeIs('classroom.*')), $this->resource->pivot?->position)
        ];
    }
}
