<?php

namespace App\Http\Controllers;

use App\Models\Enrolment;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    public function getEnrolments()
    {
        return DB::table('mdl_user_enrolments')
            ->select(DB::raw('count(*) as count'),'timecreated')
            ->groupBy('timecreated')
            ->get();
    }

    public function getCompletions()
    {
        return DB::table('mdl_course_completions')
            ->select(DB::raw('count(*) as count'),'timecompleted')
            ->groupBy('timecompleted')
            ->get();
    }

    public function getEnrolmentMethods()
    {
        return DB::table('mdl_enrol')
            ->select(DB::raw('count(*) as count'),'enrol')
            ->groupBy('enrol')
            ->get();
    }
}
