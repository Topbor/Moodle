<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function countTotalUsers(): int
    {
        return User::get()->count();
    }

    public function getPopularInstructors(): Collection
    {
        return new Collection();
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
}
