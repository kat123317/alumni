<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\College;
use App\Models\Course;
use App\Models\Event;
use App\Models\Graduate;
use App\Models\Notification;
use App\Models\Survey;
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
            'colleges' => College::with('courses')->get(),
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

    public function survey(Request $request) {
        if(Auth::user()->user_type !='admin' && Auth::user()->user_type != 'staff_admin'){
            return Redirect::route('dashboard');
        }

        $search = $request->search ?? null;

        return Inertia::render('Administrator/Survey/Index', [
            'surveys' => Survey::with('user')->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->orderBY('id','desc')->paginate(10),
            'search' => $search,
            'colleges' => College::all(),
            'courses' => Course::orderBy('college_id')->get(),
            'users' => User::whereIsActive(1)->whereStatus('approved')->whereUserType('alumni')->get(),//correct data
            // 'users' => User::whereIsActive(1)->whereStatus('approved')->get(),//for testing
            'notifications' => Notification::whereHas('user', function (Builder $query) {
                if (Auth::user()->user_type == 'admin') {
                    $query->where('status', 'pre_approved');
                } else {
                    $query->where('status', 'pending');
                }
            })->where('is_processed', false)->paginate(10)
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
