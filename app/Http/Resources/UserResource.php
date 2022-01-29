<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class UserResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->getKey(),
            'firstname'     => $this->firstname,
            'lastname'      => $this->lastname,
            'email'         => $this->email,
            'courses'       => CourseResource::collection($this->whenLoaded('courses')),
            'roles'         => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }

}
