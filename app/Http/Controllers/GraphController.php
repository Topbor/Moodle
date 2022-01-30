<?php

namespace App\Http\Controllers;

use App\Models\Enrolment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    public function getEnrolments(Request $request)
    {
        if($request->get('date')){
            return DB::table('mdl_user_enrolments')
                ->select(DB::raw('count(*) as count'),'timecreated')
                ->where('timecreated', $request->get('date'))
                ->groupBy('timecreated')
                ->get();
        }
        else{
            return DB::table('mdl_user_enrolments')
                ->select(DB::raw('count(*) as count'),'timecreated')
                ->groupBy('timecreated')
                ->get();
        }
    }

    public function getCompletions(Request $request)
    {
        if($request->get('date')){
            return DB::table('mdl_course_completions')
                ->select(DB::raw('count(*) as count'),'timecompleted')
                ->where('timecompleted', $request->get('date'))
                ->groupBy('timecompleted')
                ->get();
        }
        else{
            return DB::table('mdl_course_completions')
                ->select(DB::raw('count(*) as count'),'timecompleted')
                ->groupBy('timecompleted')
                ->get();
        }
    }

    public function getEnrolmentMethods(Request $request)
    {
        if($request->get('date')){
            return DB::table('mdl_enrol')
                ->select(DB::raw('count(*) as count'),'enrol')
                ->where('timecreated', $request->get('date'))
                ->groupBy('enrol')
                ->get();
        }
        else{
            return DB::table('mdl_enrol')
                ->select(DB::raw('count(*) as count'),'enrol')
                ->groupBy('enrol')
                ->get();
        }
    }
}
