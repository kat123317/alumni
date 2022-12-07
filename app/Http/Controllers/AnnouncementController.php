<?php

namespace App\Http\Controllers;

use App\Exports\ChartExport;
use App\Models\Announcement;
use App\Models\College;
use App\Models\Course;
use App\Models\JobPost;
use App\Models\Notification;
use App\Models\Question;
use App\Models\Record;
use App\Models\Survey;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserPosts;
use App\Models\Yearbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Str;


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
        $between = false;
        if ($request->from != null && $request->to != null) {
            $yearbook_temp_1 =Yearbook::find($request->from);
            $yearbook_temp_2 = Yearbook::find($request->to);
            $between = true;
        } else {
            $yearbook_temp_1 = null;
            $yearbook_temp_2 = null;
        }

        $notifications = Notification::with('user')->orderBy('id','desc')->get();
        $users = User::where('status','approved')->get();
        $colleges = College::with('users')->withCount('users')->with(['courses' => function($query) {
            $query->with('users');
        }])->get();
        $courses = Course::all();
        $graduates = Yearbook::withCount('graduates')->when($between, function($query, $between) use ($yearbook_temp_1, $yearbook_temp_2) {
            $query->whereBetween('schoolyear_from', [(int)$yearbook_temp_1->schoolyear_from, (int)$yearbook_temp_2->schoolyear_from]);
        })->orderBy('schoolyear_from', 'desc' )->limit(10)->get();

        $posts = UserPosts::with('user')->whereHas('user', function($query){
            $query->where('is_active', '1');
        })->with(['comments_custom' => function($query) {
            $query->with('user')->whereHas('user', function($query){
                $query->where('is_active', '1');
            })->orderBy('updated_at', 'desc');
        }])->when($search_text, function($query, $search_text){
            $query -> where('content','like',"%{$search_text}%");
        })->orderBy('created_at', 'desc')->get();
       
        $user_notification = UserNotification::with('user')->where(function($query){
            $query -> where('notification_type', 'react')
                    -> orWhere('notification_type', 'comment');
        })->where('notification_owner', Auth::user()->id)->where('is_read', 0)->orderBy('created_at', 'desc')->get();

        $survey_notifications = UserNotification::with('user')->where(['notification_type' => 'survey', 'notification_owner' => Auth::user()->id])->where('is_read', 0)->orderBy('created_at', 'desc')->get();
        $tmp_data = [];
        $tmp_array = [];
        foreach ($survey_notifications as $notif) {
                if (in_array($notif->details['survey_id'],$tmp_array) == false) {
                    $tmp_data[] = $notif;
                    $tmp_array[] = $notif->details['survey_id'];
                }
        }
        $survey_notifications = $tmp_data;
        return Inertia::render('Dashboard', [
            'notifications' => $notifications,
            'colleges' => $colleges,
            'users' => $users,
            // 'announcements' => $announcements,
            'courses' => $courses,
            'search_text' => $search_text,
            'yearbook' => $graduates,
            'yearbooks' => Yearbook::orderBy('schoolyear_from')->get(),
            'from' => $request->from,
            'to' => $request->to,
            'posts'=>$posts,
            'user_notification' => $user_notification,
            'survey_notifications' => $survey_notifications
        ]);
    }

    public function job_posts(Request $request)
    {
        $search = $request->search_text ?? null;

        $users = User::where('status','approved')->get();
        $job_posts = JobPost::with('user')->whereHas('user', function($query){
            $query->where('is_active', '1');
        })->when($search, function($query, $search){
            $query -> where('job_title','like',"%{$search}%");
        })->orderBy('updated_at', 'desc')->get();

        $user_notification = UserNotification::with('user')->where(function($query){
            $query -> where('notification_type', 'react')
                    -> orWhere('notification_type', 'comment');
        })->where('notification_owner', Auth::user()->id)->where('is_read', 0)->orderBy('created_at', 'desc')->get();

        $survey_notifications = UserNotification::with('user')->where(['notification_type' => 'survey', 'notification_owner' => Auth::user()->id])->where('is_read', 0)->orderBy('created_at', 'desc')->get();
        $tmp_data = [];
        $tmp_array = [];

        foreach ($survey_notifications as $notif) {
                if (in_array($notif->details['survey_id'],$tmp_array) == false) {
                    $tmp_data[] = $notif;
                    $tmp_array[] = $notif->details['survey_id'];
                }
        }
        $survey_notifications = $tmp_data;
        return Inertia::render('JobPosts', [
            'users' => $users,
            'posts'=>$job_posts,
            'user_notification' => $user_notification,
            'survey_notifications' => $survey_notifications,
            'search_text' => $search
        ]);
    }

    public function charts(Request $request)
    {
        //
        $search_text = $request->search_text;
        $between = false;
        $tab = $request->tab ?? null;
        if ($request->from != null && $request->to != null) {
            $yearbook_temp_1 =Yearbook::find($request->from);
            $yearbook_temp_2 = Yearbook::find($request->to);
            $between = true;
        } else {
            $yearbook_temp_1 = null;
            $yearbook_temp_2 = null;
        }

        $notifications = Notification::with('user')->orderBy('id','desc')->get();
        $users = User::where('status','approved')->get();
        $colleges = College::with('users')->withCount('users')->with(['courses' => function($query) {
            $query->with('users');
        }])->get();
        $courses = Course::all();
        $graduates = Yearbook::withCount('graduates')->when($between, function($query, $between) use ($yearbook_temp_1, $yearbook_temp_2) {
            $query->whereBetween('schoolyear_from', [(int)$yearbook_temp_1->schoolyear_from, (int)$yearbook_temp_2->schoolyear_from]);
        })->orderBy('schoolyear_from', 'desc' )->limit(10)->get();

        $surveys = Survey::with('user')->with('survey_records', function($query){
            $query -> where('status', 'complete');
        })->where(function ($query){
            $query -> where('status', 'live') -> where(function($query){
                if (Auth::user()->user_type == 'alumni') {
                    $query -> where('setup->is_private', '1');
                }
            });
        })->orderBy('updated_at', 'desc' )->get();

        return Inertia::render('Charts/Chart', [
            'notifications' => $notifications,
            'colleges' => $colleges,
            'users' => $users,
            'courses' => $courses,
            'search_text' => $search_text,
            'yearbook' => $graduates,
            'yearbooks' => Yearbook::orderBy('schoolyear_from')->get(),
            'from' => $request->from,
            'to' => $request->to,
            'tab' => $tab,
            'surveys' => $surveys
        ]);
    }

    public function survey_charts(Request $request)
    {
        $records = Record::where('survey_id', $request->survey_id)->where('status', 'complete')->get();
        $questions = Question::where('survey_id', $request->survey_id)->orderBy('order', 'asc' )->get();
        $charts = [];
        foreach ($questions as $question) {
            // dd($question->setup['input']);
            $tmp = [
                'order' => $question->order,
                'instruction' => $question->instruction
            ];
            $tmp_data = [];
            
            if($question->setup['input']==false){
                foreach ($question['setup']['choices'] as $key => $choice) {
                    $tmp_data[] = [
                        'Choice '. $key + 1 .'. '.$choice['label'],
                        $this->getRecordData($records, $question, $choice)
                    ];
                }
            }else{
                    $tmp_data[] = [
                        'Answered',
                        $this->getRecordInput($records, $question)
                    ];
                
            }
             
            $tmp['data'] = $tmp_data;
            $charts[] = $tmp;
        }
        return Inertia::render('Charts/SurveyDetails', [
            'charts' => $charts,
            'records_count' => $records->count()
        ]);
    }

    public function getRecordData($records, $question, $choice) {
        if ($question->setup['multiple_select'] == true) {
            $answer = $records->pluck('answers.question_'.$question->id.'.choice_'.$choice['value']);
            $results = $answer->countBy();
            $result = $results[1] ?? 0;
        } else {
            $answer = $records->pluck('answers.question_'.$question->id);
            $results = $answer->countBy();
            $result = $results[$choice['value']] ?? 0;
        }
        
        return  $result;
    }

    public function getRecordInput($records, $question,){
         
        $answer = $records->pluck('answers.question_'.$question->id);
        $results = $answer->count();
        return $results;
    }

    public function downloadChart(Request $request) {
        $records = Record::with('user')->where('survey_id', $request->survey_id)->where('status', 'complete')->get();
        $questions = Question::where('survey_id', $request->survey_id)->orderBy('order', 'asc' )->get();

        $results = [];
        $results[] = [$request->survey_name, '', 'Total'];

        foreach ($questions as $question) {
            $tmp = [
                'order' => $question->order,
                'instruction' =>strip_tags( $question->instruction )
            ];
            $tmp_data = [];
            if($question->setup['input']==false){
            foreach ($question['setup']['choices'] as $choice) {
                $tmp_data[] = [
                    '',
                    $choice['label'],
                    $this->getRecordData($records, $question, $choice)
                ];
            }
            }
            else{
                $tmp_data[] = [
                    '','',
                    $this->getRecordInput($records, $question)
                ];
            
            }
            $results[] = $tmp;
            
            foreach ($tmp_data as $data) {

                $results[] = $data;
            }
        }
        
        $tmp_record = [[$request->survey_name]];
        $tmp_header = ['User ID'];
        foreach ($questions as $question){
            if ($question->setup['multiple_select'] == true) {
                foreach ($question->setup['choices'] as $key => $choice) {
                    $tmp_header[] = 'Question_'.$question->order.'_'.$key+1;
                    if ($choice['write_in'] == true) {
                        $tmp_header[] = 'Question_'.$question->order.'_'.($key+1).'_write_in';
                    }
                }
            }
            else{
                $tmp_header[] = 'Question_'.$question->order;
                if ($question->setup['input'] == false && $question->setup['dropdown'] == false) {
                    foreach ($question->setup['choices'] as $key => $choice) {
                        if ($choice['write_in'] == true) {
                            $tmp_header[] = 'Question_'.$question->order.'_'.($key+1).'_write_in';
                        }
                    }
                }
            }
        }
        $tmp_record[] = $tmp_header;
        
        foreach ($records as $record) {
            $answers=[$record->user->id];
            foreach ($questions as $question){
                if ($question->setup['multiple_select'] == true) {
                    /* foreach ($record->answers['question_'.$question->id] as $answer_value) {
                        $answers[] = $answer_value;
                    } */
                    foreach ($question->setup['choices'] as $key => $choice) {
                        $answers[] = $record->answers['question_'.$question->id]['choice_'.$choice['value']];
                        if ($choice['write_in'] == true) {
                            $answers[] = $record->answers['write_in_'.$question->id]['write_'.$choice['value']];
                        }
                    }
                } else {
                    
                    if ($question->setup['input'] == false && $question->setup['dropdown'] == false) {
                        //find index of the answer
                        $index = collect($question->setup['choices'])->search(function ($choice, $key) use ($record, $question) {
                            return $choice['value'] == $record->answers['question_'.$question->id];
                        });
                        $answers[] = $index + 1; //use the index + 1 to download data
                        foreach ($question->setup['choices'] as $key => $choice) {
                            if ($choice['write_in'] == true) {
                                $answers[] = $record->answers['write_in_'.$question->id]['write_'.$choice['value']];
                            }
                        }
                    } else if($question->setup['dropdown'] == true) {
                        //find index of the answer
                        $index = collect($question->setup['choices'])->search(function ($choice, $key) use ($record, $question) {
                            return $choice['value'] == $record->answers['question_'.$question->id];
                        });
                        $answers[] = $index + 1; //use the index + 1 to download data
                    } else {
                        $answers[] = $record->answers['question_'.$question->id];
                    }
                }
            }
            $tmp_record[] = $answers;
        }
        $individual_results = [$tmp_record];


        return (new ChartExport([$results, $individual_results], ['Overall', 'Raw Data']))->download($request->survey_name." - results.xlsx");
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
    {/* 
        $foreign_ids = [];
        switch ($request->shown_only) {
            case 'college':
            case 'course':
                $foreign_ids = $request->foreign_ids;
                break;
            default: //all
                
                break;
        } */
        $images = array();
        if($request->hasfile('photos')){
            foreach($request->file('photos') as $photo){
                $imageName = Str::random(40).'.'.$photo->extension();
                $photo->move(public_path().'/images/announcements/', $imageName); 
                array_push($images, $imageName);
            }
        }
        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'photo' => $images
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
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        if($request->hasfile('photos')){
            $images = array();
            foreach ($request->file('photos') as $index => $photo) {
                if(isset($announcement->photo[$index])) {
                    $filename = explode('.', $announcement->photo[$index]);
                    $imageName = $filename[0].'.'.$photo->extension();
                } else {
                    $imageName = Str::random(40).'.'.$photo->extension();
                }
                
                $photo->move(public_path().'/images/announcements/', $imageName);

                array_push($images, $imageName.'?rnd='.Str::random(3));
            }

            $announcement->update([
                'title' => $request->title,
                'content' => $request->content,
                'updated_by' => Auth::user()->id,
                'photo' => $images
            ]);
        }
        else{
            $announcement->update([
                'title' => $request->title,
                'content' => $request->content,
                'updated_by' => Auth::user()->id
            ]);
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $announcement = Announcement::find($id);
        $announcement->delete();
        return Redirect::back();

    }
}
