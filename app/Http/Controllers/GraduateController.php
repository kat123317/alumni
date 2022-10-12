<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use App\Models\College;
use App\Models\Course;
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
        $search = $request->search ?? false;
        if ($search != null) {
            $graduates = Graduate::when($search, function($query, $search) {
                $query->where('firstname', 'like', "%{$search}%")
                    ->orWhere('middlename', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('suffix', 'like', "%{$search}%");
            })->orderBy('lastname', 'desc')->paginate(20);
        } else {
            $yearbook_id = $request->yearbook_id ?? false;
            //$course_id = $request->course_id ?? false;

            $graduates = Graduate::when($yearbook_id, function($query, $yearbook_id) {
                $query->where('yearbook_id', $yearbook_id);
            })/* ->when($college_id, function($query, $college_id) {
                $query->where('college_id', $college_id);
            })->when($course, function($query, $search) {
                $$query->where('yearbook_id', $yearbook_id);
            }) */->orderBy('lastname', 'desc')->paginate(10);
        }
        return Inertia::render('Yearbook/Graduate', [
            'graduates' => $graduates,
            'courses' => Course::all(),
            'colleges' => College::all()
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
        Graduate::create([
            'yearbook_id' => $request->yearbook_id,
            'course_id' => $request->course_id,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix
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
    public function update(Request $request, Graduate $graduate)
    {
        $graduate->update([
            'yearbook_id' => $request->yearbook_id,
            'course_id' => $request->course_id,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix
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
