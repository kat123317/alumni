<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class RecordController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }

    public function saveAnswer(Request $request, $survey_id)
    {
        $record = Record::whereUserId(Auth::user()->id)->whereSurveyId($survey_id)->first();
        if ($record == null) {
            Record::create([
                'user_id' => Auth::user()->id,
                'survey_id' => $survey_id,
                'status' => 'ongoing',
                'answers' => $request->answers
            ]);
        } else {
            $record->update([
                'answers' => $request->answers
            ]);
        }
        return Redirect::back();
    }

    public function finishSurvey(Request $request, $survey_id)
    {
        $record = Record::whereUserId(Auth::user()->id)->whereSurveyId($survey_id)->first();
        if ($request->status != 'test') {
            $record->update([
                'status' => 'complete'
            ]);
            return Redirect::route('dashboard');
        }else {
            return Redirect::back();
        }
        
    }
}
