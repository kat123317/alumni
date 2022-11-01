<?php

namespace App\Http\Controllers;

use App\Models\UserPostComment;
use App\Models\UserPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;

class SocialMediaController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Socialmedia/index', [
            // 'posts'=>UserPosts::all()

        ]);
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

    public function add_comment(Request $request)
    {   
        UserPostComment::create([
            'user_id'=>Auth::user()->id,
            'post_id' => $request->post_id,
            'content' => $request->comment,
            'details' => []
        ]);
        return Redirect::back();
    }

    public function update_comment(Request $request, $id)
    {   
        $update = UserPostComment::find($id);
        $update->update([
            'content' => $request->comment
        ]);
        return Redirect::back();
    }

    public function delete_comment($id)
    {   
        $delete = UserPostComment::find($id);
        $delete->delete();
        return Redirect::back();
    }
}
