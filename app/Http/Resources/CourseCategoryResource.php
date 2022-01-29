<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class CourseCategoryResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->getKey(),
            'name'          => $this->name,
            'description'   => $this->description,
        ];
    }

}
