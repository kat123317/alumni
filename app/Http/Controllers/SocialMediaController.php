<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\JobPost;
use App\Models\Survey;
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
            'user_profile' => User::where('id', $id)->with(['posts' => function($query){
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
        $user_surveys = Survey::whereJsonContains('setup->foriegn_ids', Auth::user()->id)->with('records')->get();
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
        $open_convo = $request->user2 ?? null;
        $users = User::where('status', 'approved')->where('is_active', true)->get();
        
        if($open_convo == null){
            $conversation = [];
        }
        else{
            $conversation = Conversation::when($open_convo, function($query) use($open_convo){
                $query->with('user1')->with('user2')->with(['messages' => function($query){
                    $query->with('user');
                }]) ->where(function ($query) use ($open_convo) {
                    $query->where('user_id_1', Auth::user()->id)->where('user_id_2', $open_convo);
                }) ->orWhere(function ($query) use ($open_convo) {
                    $query->where('user_id_1', $open_convo)->where('user_id_2', Auth::user()->id);
                });
            })->get();
            
            $user_selected = User::find($open_convo);
            if(count($conversation) == 0){
                $conversation = $user_selected;
                // dd($conversation);
            }
        }
        return Inertia::render('Socialmedia/Components/MessengerPage', [
            'users' => $users,
            'conversation' => $conversation
        ]);
    }
   
    // public function open_message(Request $request)
    // {   
    //     $users = User::where('status', 'approved')->where('is_active', true)->get();
    //     return Inertia::render('Socialmedia/Components/MessengerPage', [
    //         'users' => $users,
    //         'conversation' => Conversation::with('user1')->with('user2')->with(['messages' => function($query){
    //             $query->with('user');
    //         }])->where('user_id_1', Auth::user()->id)->get()
    //     ]);
    // }

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
