<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        return Inertia::render('Event/Index', [
            'events' => $events
        ]);
    }

    public function welcome(){
        $events = Event::all();
        return Inertia::render('Welcome', [
                    'canLogin' => Route::has('login'),
                    'canRegister' => Route::has('register'),
                    'laravelVersion' => Application::VERSION,
                    'phpVersion' => PHP_VERSION,
                    
                    'events' => $events
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
        Event::create([
            'from' => $request->from,
            'to' => $request->to,
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->update([
            'from' => $request->from,
            'to' => $request->to,
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'updated_by' => Auth::user()->id
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $event = Event::find($id);
        $event->delete();
        return Redirect::back();
    }
}
