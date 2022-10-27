<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $survey_id)
    {
        $survey = Survey::with('questions')->first($survey_id);

        return Inertia::render('Question/Index', [
            'survey' => $survey
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
    public function store(Request $request, $survey_id)
    {
        $survey = Survey::find($survey_id);

        $question_count = Question::whereSurveyId($survey_id)->count();
        Question::create([
            'survey_id' => $survey->id,
            'order' => ++$question_count,
            'type' => $request->type,
            'instruction' => $request->instruction,
            'setup' => $request->setup
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $survey_id, $id)
    {
        $question = Question::find($id);
        $question->update([
            'type' => $request->type,
            'instruction' => $request->instruction,
            'setup' => $request->setup
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($survey_id, $id)
    {
        $question = Question::find($id);
        $question->delete();
        $questions = Question::whereSurveyId($survey_id)->orderBy('order')->get()->toArray();
        foreach ($questions as $key => $q) {
            $qquestion = Question::find($q['id']);
            $qquestion->order = $key + 1;
            $qquestion->save();
        }
        return Redirect::back();
    }
}
