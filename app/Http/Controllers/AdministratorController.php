<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\College;
use App\Models\Course;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;

class AdministratorController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->user_type);
        $filter_courses = $request->id;
        if(Auth::user()->user_type =='admin'){
            return Inertia::render('Administrator/Index', [
                'colleges' => College::all(),
                'from_request' => $request->from_date ?? Carbon::today()->format('Y-m-d'),
                'to_request' => $request->to_date ?? Carbon::today()->format('Y-m-d'),
                'events' => Event::with('user')->with('updated_by')->orderBY('id','desc')->paginate(10),
                'announcements' => Announcement::with('user')->with('updated_by')->orderBY('id','desc')->paginate(10),
                'trigger' => $request->trigger ?? 1,
                'courses' => Course::with('college')->when($filter_courses, function($query, $filter_courses) {
                    $query->where('college_id', $filter_courses);
                })->paginate(5),
                'filter_courses_id' => $filter_courses
            ]);
        }
        else{
            return Redirect::route('dashboard');
        }
    }
}
