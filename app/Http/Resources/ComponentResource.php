<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class ComponentResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->getKey(),
            'position'      => $this->position,
            'component'     => $this->component,
            'title'         => $this->title,
            'font'          => $this->font,

        ];
    }

}
