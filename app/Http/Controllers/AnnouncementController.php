<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\College;
use App\Models\Course;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
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

        $notifications = Notification::with('user')->get();
        $users = User::all();
        $colleges = College::with('users')->withCount('users')->with(['courses' => function($query) {
            $query->withCount('users');
        }])->get();
        $announcements = Announcement::with('user')->when($search_text, function($query, $search_text) {
            $query->where('title', 'like', "%{$search_text}%");
        })->orderBy('id', 'desc')->get();
        $courses = Course::all();

        return Inertia::render('Dashboard', [
            'notifications' => $notifications,
            'colleges' => $colleges,
            'users' => $users,
            'announcements' => $announcements,
            'courses' => $courses,
            'search_text' => $search_text
        ]);
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
    {
        $foreign_ids = [];
        switch ($request->shown_only) {
            case 'college':
            case 'course':
                $foreign_ids = $request->foreign_ids;
                break;
            default: //all
                
                break;
        }
        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'shown_only' => $request->shown_only,
            'foreign_ids' => $foreign_ids
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
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
