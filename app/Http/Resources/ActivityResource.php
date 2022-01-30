<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class ActivityResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->getKey(),
            'name'          => $this->name,
            'description'   => $this->description,
            'user'          => new UserResource($this->whenLoaded('user')),
            'course'        => new CourseResource($this->whenLoaded('courseComp')),
        ];
    }

}
