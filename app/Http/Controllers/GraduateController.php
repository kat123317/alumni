<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use App\Models\College;
use App\Models\Course;
use App\Models\Yearbook;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;

class GraduateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $yearbook_id = $request->yearbook_id ?? null;
        $course_id = $request->course_id ?? null;
        $college_id = $request->college_id ?? null;
        if ($search != null) {
            $graduates = Graduate::with('yearbook')->with(['course' => function($query) {
                $query->with('college');
            }])->when($search, function($query, $search) {
                $query->where('firstname', 'like', "%{$search}%")
                    ->orWhere('middlename', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('suffix', 'like', "%{$search}%");
            })->orderBy('lastname', 'desc')->paginate(20);
            $yearbook_id = null;
            $course_id = null;
            $college_id = null;
        } else {
            $graduates = Graduate::with('yearbook')->with(['course' => function($query) use ($college_id) {
                $query->with('college');
            }])->when($yearbook_id, function($query, $yearbook_id) {
                $query->where('yearbook_id', $yearbook_id);
            })->when($college_id, function($query, $college_id) {
                $query->where('college_id', $college_id);
            })->when($course_id, function($query, $course_id) {
                $query->where('course_id', $course_id);
            })->orderBy('lastname', 'desc')->paginate(10);
        }
        $colleges = College::all();
        $courses = Course::when($college_id, function($query, $college_id) {
            $query->where('college_id', $college_id);
        })->get();
        return Inertia::render('Yearbook/Graduate', [
            'yearbooks' => Yearbook::all(),
            'graduates' => $graduates,
            'colleges' => $colleges,
            'courses' => $courses,
            'search' => $search,
            'yearbook_id' => $yearbook_id,
            'course_id' => $course_id,
            'college_id' => $college_id
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
        // $request->validate([
        //     'profile_data' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        // ]);
        $details = $request->details;
        if($request->hasfile('profile_data')){
            $imageName = time().'.'.$request->profile_data->extension();
            $request->profile_data->move(public_path().'/images/graduates/', $imageName); 
            $details['profile_picture'] = $imageName;
        }
        Graduate::create([
            'yearbook_id' => $request->yearbook_id,
            'course_id' => $request->course_id,
            'college_id' => $request->college_id,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'details' => $details
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function show(Graduate $graduate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function edit(Graduate $graduate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $graduate = Graduate::find($id);
        $details = $request->details;
        if($request->hasfile('profile_data')){
            $tmp_img = explode('.',$graduate->details['profile_picture']);
            if ($tmp_img[0] == null || $tmp_img[0] == '') {
                $tmp_img[0] = time();
            }
            $imageName = $tmp_img[0].'.'.$request->profile_data->extension();
            $request->profile_data->move(public_path().'/images/graduates/', $imageName); 
            $details['profile_picture'] = $imageName.'?rnd='.rand(1,10);
        }
        $graduate->update([
            'yearbook_id' => $request->yearbook_id,
            'college_id' => $request->college_id,
            'course_id' => $request->course_id,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'details' => $details
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduate $graduate)
    {
        //
    }
}
