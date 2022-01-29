<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class CourseResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->getKey(),
            'fullname'      => $this->fullname,
            'shortname'     => $this->shortname,
            'summary'       => $this->summary,
            'startdate'     => $this->startdate,
            'enddate'       => $this->enddate,
            'category'      =>  new CourseCategoryResource($this->whenLoaded('courseCategory')),
        ];
    }

}
