<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class RoleResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->getKey(),
            'shortname'      =>  $this->shortname,
            'description'    =>$this->description,
        ];
    }

}
