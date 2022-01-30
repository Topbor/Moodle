<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Models\Completions;
use App\Models\Enrolment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityController extends Controller
{
    public function lastActivities(): AnonymousResourceCollection
    {
        $enrolments = Enrolment::with(['user', 'courseComp'])->orderByDesc('timecreated')->take(4)->get();
        $completions = Completions::with(['user', 'courseComp'])->orderByDesc('timecompleted')->take(4)->get();
        $lastCompleted = Completions::lastCompleted($completions);
        $lastEnrolment = Enrolment::lastEnrolment($enrolments);
        $array = array_merge($lastCompleted, $lastEnrolment);
        rsort($array);
        array_splice($array, 4);
        $activities = new Collection();
        foreach($array as $curr){
            if($curr['type'] === 'enrolment'){
                $action = Enrolment::with(['user', 'courseComp', 'user.roles'])->find($curr['id']);
            }
            else{
                $action = Collection::with(['user', 'courseComp', 'user.roles'])->find($curr['id']);
            }
            $activities->push($action);
        }
        return ActivityResource::collection($activities);
    }
}
