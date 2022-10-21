<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\College;
use App\Models\Event;
use Carbon\Carbon;
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
                'colleges' => College::all(),
                'from_request' => $request->from_date ?? Carbon::today()->format('Y-m-d'),
                'to_request' => $request->to_date ?? Carbon::today()->format('Y-m-d'),
                'events' => Event::with('user')->with('updated_by')->orderBY('id','desc')->paginate(10),
                'announcements' => Announcement::with('user')->with('updated_by')->orderBY('id','desc')->paginate(10),
                'trigger' => $request->trigger ?? 1
            ]);
        }
        else{
            return Redirect::route('dashboard');
        }
    }
}
