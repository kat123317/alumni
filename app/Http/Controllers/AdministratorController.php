<?php

namespace App\Http\Controllers;

use App\Models\College;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;

class AdministratorController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->user_type);
        if(Auth::user()->user_type =='admin'){
            return Inertia::render('Administrator/Index', [
                'colleges' => College::all()
            ]);
        }
        else{
            return Redirect::route('dashboard');
        }
    }
}
