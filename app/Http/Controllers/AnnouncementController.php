<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\College;
use App\Models\Course;
use App\Models\JobPost;
use App\Models\Notification;
use App\Models\Question;
use App\Models\Record;
use App\Models\Survey;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserPosts;
use App\Models\Yearbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $search_text = $request->search_text;
        $between = false;
        if ($request->from != null && $request->to != null) {
            $yearbook_temp_1 =Yearbook::find($request->from);
            $yearbook_temp_2 = Yearbook::find($request->to);
            $between = true;
        } else {
            $yearbook_temp_1 = null;
            $yearbook_temp_2 = null;
        }

        $notifications = Notification::with('user')->orderBy('id','desc')->get();
        $users = User::where('status','approved')->get();
        $colleges = College::with('users')->withCount('users')->with(['courses' => function($query) {
            $query->with('users');
        }])->get();
        $courses = Course::all();
        $graduates = Yearbook::withCount('graduates')->when($between, function($query, $between) use ($yearbook_temp_1, $yearbook_temp_2) {
            $query->whereBetween('schoolyear_from', [(int)$yearbook_temp_1->schoolyear_from, (int)$yearbook_temp_2->schoolyear_from]);
        })->orderBy('schoolyear_from', 'desc' )->limit(10)->get();
        $posts = UserPosts::with(['user' => function($query){
            $query->where('is_active', '1');
        }])->with(['comments_custom' => function($query) {
            $query->with(['user' => function($query){
                $query->where('is_active', '1');
            }])->orderBy('updated_at', 'desc');
        }])->when($search_text, function($query, $search_text){
            $query -> where('content','like',"%{$search_text}%");
        })->orderBy('created_at', 'desc')->get();
        $user_notification = UserNotification::with('user')->where('notification_owner', Auth::user()->id)->where('is_read', 0)->orderBy('created_at', 'desc')->get();
        return Inertia::render('Dashboard', [
            'notifications' => $notifications,
            'colleges' => $colleges,
            'users' => $users,
            // 'announcements' => $announcements,
            'courses' => $courses,
            'search_text' => $search_text,
            'yearbook' => $graduates,
            'yearbooks' => Yearbook::orderBy('schoolyear_from')->get(),
            'from' => $request->from,
            'to' => $request->to,
            'posts'=>$posts,
            'user_notification' => $user_notification
        ]);
    }

    public function job_posts(Request $request)
    {
        $search = $request->search_text ?? null;

        $users = User::where('status','approved')->get();
        $job_posts = JobPost::with(['user' => function($query){
            $query->where('is_active', '1');
        }])->when($search, function($query, $search){
            $query -> where('job_title','like',"%{$search}%");
        })->orderBy('updated_at', 'desc')->get();
        $user_notification = UserNotification::with('user')->where('notification_owner', Auth::user()->id)->where('is_read', 0)->orderBy('created_at', 'desc')->get();
        return Inertia::render('JobPosts', [
            'users' => $users,
            'posts'=>$job_posts,
            'user_notification' => $user_notification,
            'search_text' => $search
        ]);
    }

    public function charts(Request $request)
    {
        //
        $search_text = $request->search_text;
        $between = false;
        $tab = $request->tab ?? null;
        if ($request->from != null && $request->to != null) {
            $yearbook_temp_1 =Yearbook::find($request->from);
            $yearbook_temp_2 = Yearbook::find($request->to);
            $between = true;
        } else {
            $yearbook_temp_1 = null;
            $yearbook_temp_2 = null;
        }

        $notifications = Notification::with('user')->orderBy('id','desc')->get();
        $users = User::where('status','approved')->get();
        $colleges = College::with('users')->withCount('users')->with(['courses' => function($query) {
            $query->with('users');
        }])->get();
        // $announcements = Announcement::with('user')->when($search_text, function($query, $search_text) {
        //     $query->where('title', 'like', "%{$search_text}%");
        // })->orderBy('id', 'desc')->get();
        $courses = Course::all();
        $graduates = Yearbook::withCount('graduates')->when($between, function($query, $between) use ($yearbook_temp_1, $yearbook_temp_2) {
            $query->whereBetween('schoolyear_from', [(int)$yearbook_temp_1->schoolyear_from, (int)$yearbook_temp_2->schoolyear_from]);
        })->orderBy('schoolyear_from', 'desc' )->limit(10)->get();

        $surveys = Survey::with('user')->orderBy('updated_at', 'desc' )->get();

        return Inertia::render('Charts/Chart', [
            'notifications' => $notifications,
            'colleges' => $colleges,
            'users' => $users,
            // 'announcements' => $announcements,
            'courses' => $courses,
            'search_text' => $search_text,
            'yearbook' => $graduates,
            'yearbooks' => Yearbook::orderBy('schoolyear_from')->get(),
            'from' => $request->from,
            'to' => $request->to,
            'tab' => $tab,
            'surveys' => $surveys
        ]);
    }

    public function survey_charts(Request $request)
    {
        $records = Record::where('survey_id', $request->survey_id)->where('status', 'complete')->get();
        $questions = Question::where('survey_id', $request->survey_id)->orderBy('order', 'asc' )->get();
        $charts = [];
        foreach ($questions as $question) {
            $tmp = [
                'instruction' => $question->instruction
            ];
            $tmp_data = [];
            foreach ($question['setup']['choices'] as $choice) {
                $tmp_data[] = [
                    $choice['label'],
                    $this->getRecordData($records, $choice)
                ];
            }
            $tmp['data'] = $tmp_data;
            $charts[] = $tmp;
        }
        return Inertia::render('Charts/SurveyDetails', [
            'charts' => $charts,
            'records_count' => $records->count()
        ]);
    }

    public function getRecordData($records, $choice) {
        return $records->count();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {/* 
        $foreign_ids = [];
        switch ($request->shown_only) {
            case 'college':
            case 'course':
                $foreign_ids = $request->foreign_ids;
                break;
            default: //all
                
                break;
        } */
        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'updated_by' => Auth::user()->id
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'updated_by' => Auth::user()->id
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $announcement = Announcement::find($id);
        $announcement->delete();
        return Redirect::back();

    }
}
