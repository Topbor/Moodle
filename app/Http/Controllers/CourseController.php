<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseController extends Controller
{
    public function countTotalCourses(): int
    {
        return Course::get()->count();
    }

    public function lastCourses(): AnonymousResourceCollection
    {
        $courses = Course::orderBy('timecreated', 'desc')->take(4)->get();
        $courses->load('courseCategory');
        return CourseResource::collection($courses);
    }
}
