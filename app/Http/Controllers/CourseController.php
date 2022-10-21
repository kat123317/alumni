<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        if($request->hasfile('logo')){
            $imageName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path().'/images/courses/', $imageName); 
        }

        Course::create([
            'college_id' => $request->college_id,
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'logo' => $imageName
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if($request->hasfile('logo')){
            $imageName = $course->logo;
            $filename = explode('.', $course->logo);
            $imageName = $filename[0].'.'.$request->logo->extension();
            $request->logo->move(public_path().'/images/courses/', $imageName);
        $course->update([
            'college_id' => $request->college_id,
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'logo' => $imageName.'?rnd='.rand(1, 100)
        ]);
    } else {
        $course->update([
            'college_id' => $request->college_id,
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
        ]);
    }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return Redirect::back();
    }
}
