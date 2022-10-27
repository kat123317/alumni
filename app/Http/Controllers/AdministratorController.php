<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\College;
use App\Models\Course;
use App\Models\Event;
use App\Models\Graduate;
use App\Models\Notification;
use App\Models\User;
use App\Models\Yearbook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;

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
        $user_search_key = $request->user_search_key ?? null;
        $notification_search_key = $request->notification_search_key ?? null;
        $year_search_key = $request->year_search_key ?? null;
        $alumni_search_key = $request->alumni_search_key ?? null;
        $notification_search_key = $request->notification_search_key ?? null;
        if(Auth::user()->user_type =='admin' || Auth::user()->user_type =='staff_admin'){
            return Inertia::render('Administrator/Index', [
                'yearbooks' => Yearbook::when($year_search_key, function($query, $year_search_key) {
                    $query->where('schoolyear_from', 'like', "%{$year_search_key}%")
                        ->orWhere('schoolyear_to', 'like', "%{$year_search_key}%");
                })->paginate(10),
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
                'users' => User::with('college')->with('course')->where('status', 'approved')->when($user_search_key, function($query, $user_search_key) {
                    $query->where('name', 'like', "%{$user_search_key}%");
                })->paginate(10),
                'notifications' => Notification::whereHas('user', function (Builder $query) {
                    if (Auth::user()->user_type == 'admin') {
                        $query->where('status', 'pre_approved');
                    } else {
                        $query->where('status', 'pending');
                    }
                })->with(['user' => function($query) {
                    $query->with('college')->with('course'); 
                }])->when($notification_search_key, function($query, $notification_search_key) {
                    $query->where('content', 'like', "%{$notification_search_key}%");
                })->where('is_processed', false)->paginate(10),
                'graduates' => Graduate::with('yearbook')->with(['course' => function($query) {
                    $query->with('college');
                }])->when($alumni_search_key, function($query, $alumni_search_key) {
                    $query->where('firstname', 'like', "%{$alumni_search_key}%")
                        ->orWhere('middlename', 'like', "%{$alumni_search_key}%")
                        ->orWhere('lastname', 'like', "%{$alumni_search_key}%")
                        ->orWhere('suffix', 'like', "%{$alumni_search_key}%");
                })->orderBy('lastname', 'desc')->paginate(20),
                'notification_search_key' => $notification_search_key,
                'alumni_search_key'=> $alumni_search_key,
                'filter_courses_id' => $filter_courses_id,
                'announcement_search_key' => $announcement_search_key,
                'event_search_key' => $event_search_key,
                'user_search_key' => $user_search_key,
                'notification_search_key' => $notification_search_key,
                'year_search_key' => $year_search_key,
            ]);
        }
        else{
            return Redirect::route('dashboard');
        }
    }

    public function announcement(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }

        $search = $request->search ?? null;
        return Inertia::render('Administrator/Announcement', [
            'announcements' => Announcement::when($search, function($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            })->with('user')->with('updated_by')->orderBY('id','desc')->paginate(10),
            'search' => $search,
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->with(['user' => function($query) {
                $query->with('college')->with('course'); 
            }])->where('is_processed', false)->paginate(10)
        ]);
            
    }

    public function yearbook(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }
        
        $search = $request->search ?? null;
        return Inertia::render('Administrator/Yearbook', [
            'yearbooks' => Yearbook::when($search, function($query, $search) {
                $query->where('schoolyear_from', 'like', "%{$search}%")
                    ->orWhere('schoolyear_to', 'like', "%{$search}%");
            })->paginate(10),
            'search' => $search,
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->with(['user' => function($query) {
                $query->with('college')->with('course'); 
            }])->where('is_processed', false)->paginate(10)
        ]);
            
    }

    public function alumni(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }
        
        $search = $request->search ?? null;
        return Inertia::render('Administrator/Alumni', [
            'graduates' => Graduate::with('yearbook')->with(['course' => function($query) {
                $query->with('college');
            }])->when($search, function($query, $search) {
                $query->where('firstname', 'like', "%{$search}%")
                    ->orWhere('middlename', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('suffix', 'like', "%{$search}%");
            })->orderBy('lastname', 'desc')->paginate(20),
            'search' => $search,
            'yearbooks' => Yearbook::all(),
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->with(['user' => function($query) {
                $query->with('college')->with('course'); 
            }])->where('is_processed', false)->paginate(10)
        ]);
            
    }

    public function user_management(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }
        
        $search = $request->search ?? null;
        return Inertia::render('Administrator/UserManagement', [
            'users' => User::with('college')->with('course')->where('status', 'approved')->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->paginate(10),
            'search' => $search,
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->with(['user' => function($query) {
                $query->with('college')->with('course'); 
            }])->where('is_processed', false)->paginate(10)
        ]);
            
    }

    public function department(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }

        $colleges = College::with('courses')->get();

        return Inertia::render('Administrator/Department', [
            'colleges' => $colleges,
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->with(['user' => function($query) {
                $query->with('college')->with('course'); 
            }])->where('is_processed', false)->paginate(10)
        ]);
            
    }

    public function course(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }

        $colleges = College::with('courses')->get();
        if ($colleges->count() > 0 && !isset($request->search)) {
            $search = $colleges[0]->search;
        } else {
            $search = $request->search;
        }

        return Inertia::render('Administrator/Course', [
            'colleges' => $colleges,
            'courses' => Course::with('college')->when($search, function($query, $search) {
                $query->where('college_id', $search);
            })->paginate(5),
            'search' => $search,
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->with(['user' => function($query) {
                $query->with('college')->with('course'); 
            }])->where('is_processed', false)->paginate(10)
        ]);
            
    }

    public function event(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }

        $search = $request->search ?? null;

        return Inertia::render('Administrator/Event', [
            'events' => Event::when($search, function($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            })->with('user')->with('updated_by')->orderBY('id','desc')->paginate(10),
            'search' => $search,
            'from_date' => $request->from_date ?? Carbon::today()->format('Y-m-d'),
            'to_date' => $request->to_date ?? Carbon::today()->format('Y-m-d'),
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->where('is_processed', false)->paginate(10)
        ]);
            
    }

    public function notification(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }

        $search = $request->search ?? null;

        return Inertia::render('Administrator/Notification', [
            'search' => $search,
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->with(['user' => function($query) {
                $query->with('college')->with('course'); 
            }])->when($search, function($query, $search) {
                $query->where('content', 'like', "%{$search}%");
            })->where('is_processed', false)->paginate(10),
        ]);
            
    }

}
