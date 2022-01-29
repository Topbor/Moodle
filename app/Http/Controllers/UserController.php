<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Resources\UserResource;
use App\Models\LastAccess;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function countTotalUsers(): int
    {
        return User::get()->count();
    }

    public function countTotalInstructors(): int
    {
       $users = User::with(['roles'])->get();
       return count(User::getInstructors($users));
    }

    public function countTotalStudents(): int
    {
        $users = User::with(['roles'])->get();
        return count(User::getStudents($users));
    }

    public function lastInstructors()
    {
        $access = LastAccess::with(['user'])->orderByDesc('timeaccess')->take(4)->get();
        $userIds = $access->reduce(function(array $acc, $curr){
            $acc[] = $curr->user->id;
            return $acc;
        }, []);
        $users = User::whereIn('id', array_unique($userIds))->with('courses')->get();

        return UserResource::collection($users);
    }
}
