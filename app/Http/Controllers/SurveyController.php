<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\Record;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use App\Mail\SurveyNotification;



class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::all();

        return Inertia::render('Survey/Index', [
            'surveys' => $surveys
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
            'name' => ['required']
        ]);
        Survey::create([
            'user_id' => Auth::user()->id,
            'status' => 'draft',
            'name' => $request->name,
            'setup' => $request->setup
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required']
        ]);
        $survey = Survey::find($id);
        $survey->update([
            'name' => $request->name,
            'setup' => $request->setup
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $survey = Survey::find($id);
 
        $survey->delete();
        return Redirect::back();
    }

    public function copy($id)
    {
        $survey = Survey::find($id);
        $questions = Question::where(['survey_id' => $survey->id])->get();

        $new_survey = $survey->replicate()->fill([
            'status' => 'draft',
            'name' => $survey->name .' Copy'
        ]);
        $new_survey->save();

        foreach ($questions as $question) {
            $new_question = $question->replicate()->fill([
                'survey_id' => $new_survey->id
            ]);
            $new_question->save();
        }
        
        return Redirect::back();
    }

    public function sendSurveyInvitation(Request $request, $id)
    {
        $survey = Survey::find($id);
        $survey->update([
            'status' => 'live',
            'setup' => $request->setup
        ]);
        switch ($survey->setup['shown_only']) {
            case 'college':
                $users = User::whereIn('college_id', $survey->setup['foreign_ids'])->get();
                break;
            case 'courses':
                $users = User::whereIn('course_id', $survey->setup['foreign_ids'])->get();
                break;
            case 'user':
                $users = User::whereIn('id', $survey->setup['foreign_ids'])->get();
                break;
            default:
                $users = User::whereIsActive(1)->whereStatus('approved')->whereUserType('alumni')->get();
                break;
        }

        // dd($users);
        foreach ($users as $user) {
            UserNotification::create([
                'user_id' => Auth::user()->id,
                'notification_owner' => $user->id,
                'notification_type' => 'survey',
                'is_read' => false,
                'title' => 'Alumni Survey',
                'content' => 'You are invited to alumni survey',
                'details' => array(
                    'link' => route('surveys.engine.review', ['survey_id' => $survey->id]),
                    'survey_id' => $survey->id
                )
            ]);

            try {
                Mail::to($user->email)->send(new SurveyNotification($user->email));
            } catch (\Throwable $th) {
                //throw $th;
            }
            
        }
        return Redirect::back();
    }

    public function review(Request $request, $survey_id)
    {
        $survey = Survey::with('questions')->where('id', $survey_id)->first();
        $record = Record::whereUserId(Auth::user()->id)->whereSurveyId($survey_id)->first();

        return Inertia::render('SurveyEngine/Index', [
            'survey' => $survey,
            'record' => $record,
            "user" => Auth::user()
        ]);
    }
}
