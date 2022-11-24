<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\Conversation;
use App\Models\JobPost;
use App\Models\Message;
use App\Models\Survey;
use App\Models\Record;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserPostComment;
use App\Models\UserPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SocialMediaController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Socialmedia/index', [
            // 'posts'=>UserPosts::all()

        ]);
    }

    public function user_profile($id)
    {   
        return Inertia::render('Socialmedia/Components/UserProfile', [
            'user_profile' => User::where('id', $id)->with('course')->with('college')->with(['posts' => function($query){
                $query->with('user')->orderBy('created_at', 'desc')->with(['comments' => function($query) {
                    $query->with('user')->orderBy('created_at', 'desc');
                }]);
            }])->get()
        ]);
    }

    public function user_surveys()
    {   
        // $update = Survey::with('records')->get();
        // // dd($update[0]->setup->foreign_ids[0]);
        // $key = collect($update[0]->setup->foreign_ids[0])->search(function($value) {
        //     return  Auth::user()->id == $value['id'];
        // });
        // $user_surveys = UserNotification::where('notification_owner', Auth::user()->id)->where('notification_type', 'survey')->orderBy('created_at', 'desc')->get();
        
        $survey_notifications = UserNotification::where(['notification_type' => 'survey', 'notification_owner' => Auth::user()->id])->orderBy('created_at', 'desc')->get();
        $survey_notifications = $survey_notifications->unique('details->survey_id');
        $user_surveys = [];
        foreach ($survey_notifications as $notification) {
            $survey = Survey::with('questions')->find($notification->details['survey_id']);
            $tmp = $notification;
            $tmp['record'] = Record::whereUserId(Auth::user()->id)->whereSurveyId($survey->id)->first();
            $tmp['survey'] = $survey;
            $user_surveys[] = $tmp;
        }
        // dd($user_surveys);
        return Inertia::render('Socialmedia/Components/Surveys', [
            'user_surveys' => $user_surveys
        ]);
    }

    public function open_notif(Request $request, $id)
    {   
        $update = UserNotification::find($id);
        $update->update([
            'is_read' => $request->is_read
        ]);

        if($request->notif_type == "survey"){
            return Redirect::route("socialmedia.user_surveys");
        }
        else{
            return Redirect::route("socialmedia.comments", [$request->id]);
        }
    }

    public function comments(Request $request, $id)
    {   
        // $post= UserPosts::find($id);
        return Inertia::render('Socialmedia/Components/Comments', [
            'post'=>UserPosts::where('id', $id)->with('user')->with(['comments' => function($query) {
                $query->with('user')->orderBy('created_at', 'desc');
            }])->get()
        ]);
    }

    public function messaging(Request $request)
    {   
        // $user_selected ='';
        $open_convo = ($request->conversation_id == null || $request->conversation_id == '') == true ? null : $request->conversation_id;
        $users = User::whereNot('id', Auth::user()->id)->where('status', 'approved')->where('is_active', true)->get();
           
        if($open_convo == null && $request->selected_user_id !=  null){
            $conversation = Conversation::where(['user_id_1' => Auth::user()->id, 'user_id_2' => $request->selected_user_id])->orWhere(['user_id_2' => Auth::user()->id, 'user_id_1' => $request->selected_user_id])->first();
            if ($conversation == null) {
                $conversation = Conversation::create([
                    'user_id_1' => Auth::user()->id,
                    'user_id_2' => $request->selected_user_id,
                    'read' => []
                ]);
            }            
            $open_convo = $conversation->id;
        }
        $conversations = Conversation::with('user1')->with('user2')->where('user_id_1', Auth::user()->id)->orWhere('user_id_2', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
        if ($open_convo != null) {
            $conversation = Conversation::find($open_convo);
            $tmp_read = $conversation->read;
            if (in_array(Auth::user()->id, $tmp_read) == false) {
                $tmp_read[] = Auth::user()->id;
                $conversation->update([
                    'read' => $tmp_read
                ]);
            }
            $messages = Message::where('conversation_id', $open_convo)->with('user')->get();
        } else {
            $messages = [];
        }
        
        if ($request->selected_user_id == null) {
            $user_selected = null;
        } else {
            $user_selected = User::find($request->selected_user_id);
        }

        return Inertia::render('Socialmedia/Components/MessengerPage', [
            'users' => $users,
            'conversations' => $conversations,
            'messages' => $messages,
            'user_selected' => $user_selected,
            'conversation_id' => $open_convo,
            'user' => Auth::user()
        ]);
    }
   
    public function send_message(Request $request)
    {   
        $conversation = Conversation::find($request->conversation_id);
        Message::create([
            'user_id'=>Auth::user()->id,
            'conversation_id'=>$request->conversation_id,
            'content'=>$request->content,
        ]);

        $conversation->update([
            'read' => [Auth::user()->id]
        ]);
        broadcast(new SendMessage($conversation));
        return response()->json([
            'status' => true
        ], 200);
    }

    public function add_comment(Request $request)
    {   
        
        UserPostComment::create([
            'user_id'=>Auth::user()->id,
            'post_id' => $request->post_id,
            'content' => $request->comment,
            'details' => []
        ]);
        $details =array(
            'post_id'=>  $request->post_id,
        );
        UserNotification::create([
            'user_id'=>Auth::user()->id,
            'notification_type'=>'comment',
            'notification_owner'=>$request->post_owner,
            'is_read'=>false,
            'title'=>'Commented',
            'content'=> $request->comment,
            'details'=>$details
        ]);
        return Redirect::back();
    }

    public function store(Request $request)
    {   
        $images = array();
        if($request->hasfile('photos')){
            foreach($request->file('photos') as $photo){
                $imageName = Str::random(40).'.'.$photo->extension();
                $photo->move(public_path().'/images/posts/', $imageName); 
                array_push($images, $imageName);
            }
        }
        $post_details = array(
            'like'=>[]
        );
        UserPosts::create([
            'user_id'=>Auth::user()->id,
            'content' => $request->content,
            'photo' => $images,
            'details' => $post_details
        ]);
        return Redirect::back();
    }

    public function post_job(Request $request)
    {   
        $input = $request->toArray();
        Validator::make($input, [
            'job_email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();
        
        JobPost::create([
            'user_id'=>Auth::user()->id,
            'job_title' => $request->job_title,
            'job_description' => $request->job_description,
            'job_email' => $request->job_email,
            'job_salary' => $request->job_salary,
            'job_company'=>$request->job_company,
            'details' => []
        ]);
        return Redirect::back();
    }

    public function update_post(Request $request, $id)
    {   
        $update = UserPosts::find($id);
        $update->update([
            'content' => $request->content
        ]);
        return Redirect::back();
    }

    public function like_post(Request $request, $id)
    {   
        $update = UserPosts::find($id);
        $details = $update->details;
        $details['like'][] = ['id'=>Auth::user()->id, 'name'=>Auth::user()->name];
        $update->update([
            'details' => $details
        ]);

        $details =array(
            'post_id'=>  $request->post_id,
        );
        UserNotification::create([
            'user_id'=>Auth::user()->id,
            'notification_type'=>'react',
            'notification_owner'=>$request->post_owner,
            'is_read'=>false,
            'title'=>'Like',
            'content'=> 'Like your post',
            'details'=>$details
        ]);
        
        return Redirect::back();
    }

    public function unlike_post(Request $request, $id)
    {   
        $update = UserPosts::find($id);
        $details = $update->details;
        $key = collect($details['like'])->search(function($value) {
            return  Auth::user()->id == $value['id'];
        });
        unset($details['like'][$key]);
        $details['like'] = array_values($details['like']);
        $update->update([
            'details' => $details
        ]);
        return Redirect::back();
    }

    public function update_comment(Request $request, $id)
    {   
        $update = UserPostComment::find($id);
        $update->update([
            'content' => $request->comment
        ]);

        $details =array(
            'post_id'=>  $request->post_id,
        );
        UserNotification::create([
            'user_id'=>Auth::user()->id,
            'notification_type'=>'comment',
            'notification_owner'=>$request->post_owner,
            'is_read'=>false,
            'title'=>'Update comment',
            'content'=> $request->comment,
            'details'=>$details
        ]);
        return Redirect::back();
    }

    public function update_job_post(Request $request, $id)
    {   

        $input = $request->toArray();
        Validator::make($input, [
            'job_email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();

        $update = JobPost::find($id);
        $update->update([
            'job_title' => $request->job_title,
            'job_description' => $request->job_description,
            'job_email' => $request->job_email,
            'job_salary' => $request->job_salary,
            'job_company'=>$request->job_company,
        ]);
        return Redirect::back();
    }

    public function delete_comment($id)
    {   
        $delete = UserPostComment::find($id);
        $delete->delete();
        return Redirect::back();
    }

    public function delete_post($id)
    {   
        $delete = UserPosts::find($id);
        $delete->delete();
        return Redirect::route('dashboard');
    }

    public function delete_job_post($id)
    {   
        $delete = JobPost::find($id);
        $delete->delete();
        return Redirect::back();
    }
}
