<?php

namespace App\Http\Controllers;

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
        $post= UserPosts::find($id);
        return Inertia::render('Socialmedia/Components/Comments', [
            'post'=>$post->with('user')->with(['comments' => function($query) {
                $query->with('user');
            }])->get()
        ]);
    }
}
