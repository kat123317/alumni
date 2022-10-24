<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\College;
use App\Models\Course;
use App\Models\Event;
use App\Models\User;
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
        $colleges = College::with('courses')->get();
        if ($colleges->count() > 0 && !isset($request->id)) {
            $filter_courses_id = $colleges[0]->id;
        } else {
            $filter_courses_id = $request->id;
        }

        $announcement_search_key = $request->announcement_search_key ?? null;
        $event_search_key = $request->event_search_key ?? null;
        if(Auth::user()->user_type =='admin'){
            return Inertia::render('Administrator/Index', [
                'colleges' => $colleges,
                'from_request' => $request->from_date ?? Carbon::today()->format('Y-m-d'),
                'to_request' => $request->to_date ?? Carbon::today()->format('Y-m-d'),
                'events' => Event::when($event_search_key, function($query, $event_search_key) {
                    $query->where('title', 'like', "%{$event_search_key}%")
                        ->orWhere('content', 'like', "%{$event_search_key}%");
                })->with('user')->with('updated_by')->orderBY('id','desc')->paginate(10),
                'announcements' => Announcement::when($announcement_search_key, function($query, $announcement_search_key) {
                    $query->where('title', 'like', "%{$announcement_search_key}%")
                        ->orWhere('content', 'like', "%{$announcement_search_key}%");
                })->with('user')->with('updated_by')->orderBY('id','desc')->paginate(10),
                'trigger' => $request->trigger ?? 1,
                'courses' => Course::with('college')->when($filter_courses_id, function($query, $filter_courses_id) {
                    $query->where('college_id', $filter_courses_id);
                })->paginate(5),
                'filter_courses_id' => $filter_courses_id,
                'users' => User::all()
            ]);
        }
        else{
            return Redirect::route('dashboard');
        }
    }
}
