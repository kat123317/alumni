<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\College;
use App\Models\Course;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges = College::all();

        return Inertia::render('College/Index', [
            'colleges' => $colleges
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
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        if($request->hasfile('logo')){
            $imageName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path().'/images/colleges/', $imageName); 
        }
        College::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'logo' => $imageName
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function show(College $college)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function edit(College $college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $college = College::find($id);
        if($request->hasfile('logo')){
            $imageName = $college->logo;
            $filename = explode('.', $college->logo);
            $imageName = $filename[0].'.'.$request->logo->extension();
            $request->logo->move(public_path().'/images/colleges/', $imageName);
            $college->update([
                'name' => $request->name,
                'abbreviation' => $request->abbreviation,
                'logo' => $imageName.'?rnd='.rand(1, 100)
            ]);
        } else {
            $college->update([
                'name' => $request->name,
                'abbreviation' => $request->abbreviation
            ]);
        }
        
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $college = College::find($id);
        $college->delete();
        return Redirect::back();
    }
}
