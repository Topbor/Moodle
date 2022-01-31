<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComponentResource;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConstructorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $components = Component::orderBy('position')->get();

        return ComponentResource::collection($components);
    }

    public function show($id)
    {
        $component = Component::find($id);

        return new ComponentResource($component);
    }

    public function update($id, Request $request)
    {
        $component = Component::find($id);
        $component->fill($request->all());
        $component->save();

        return new ComponentResource($component);
    }
}
