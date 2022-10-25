<?php

namespace App\Http\Controllers;

use App\Models\Yearbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;

class YearbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yearbooks = Yearbook::all();

        return Inertia::render('Yearbook/Index', [
            'yearbooks' => $yearbooks
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
        Yearbook::create([
            'schoolyear_from' => $request->schoolyear_from,
            'schoolyear_to' => $request->schoolyear_to
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Yearbook  $yearbook
     * @return \Illuminate\Http\Response
     */
    public function show(Yearbook $yearbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Yearbook  $yearbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Yearbook $yearbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Yearbook  $yearbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $yearbook = Yearbook::find($id);
        $yearbook->update([
            'schoolyear_from' => $request->from_date_update,
            'schoolyear_to' => $request->to_date_update
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Yearbook  $yearbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $yearbook = Yearbook::find($id);
        $yearbook->delete();
        return Redirect::back();
    }
}
