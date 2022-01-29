<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompletionResource;
use App\Models\Completions;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityController extends Controller
{
    public function lastActivities(): AnonymousResourceCollection
    {
        $userLastEnrolments = Completions::with(['user', 'courseComp'])->orderByDesc('timeenrolled')->take(4)->get();
        $userLastCompleted = Completions::with(['user', 'courseComp'])->orderByDesc('timecompleted')->take(4)->get();
        $lastCompleted = Completions::lastCompleted($userLastCompleted);
        $lastEnrolment = Completions::lastEnrolment($userLastEnrolments);
        $array = array_merge($lastCompleted, $lastEnrolment);
        rsort($array);
        array_splice($array, 4);
        $activities = Completions::whereIn('id', array_column($array, 'id'))->with(['user', 'courseComp', 'user.roles'])->get();

        return CompletionResource::collection($activities);
    }
}
