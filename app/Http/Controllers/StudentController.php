<?php

namespace App\Http\Controllers;

use App\Http\ModelFilters\UserFilter;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class StudentController extends Controller
{
    public function students(Request $request): AnonymousResourceCollection
    {
        $users = User::filter($request->query->all(), UserFilter::class)->with(['roles'])->get();
        $students = $this->paginate(User::getStudents($users));

        return UserResource::collection($students);
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof User ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
