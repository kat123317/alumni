<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    use PasswordValidationRules;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function register(Request $request){
        $input = $request->toArray();
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            // 'status' => ['required', 'string', 'max:255'],
            // 'user_type' => ['required', 'string', 'max:255'],
            'college_id' => ['required', 'integer'],
            'course_id' => ['required', 'integer'],
            'date_of_birth' => ['required', 'date'],
            'religion'=>['required', 'string'],
            'civil_status'=>['required'],
            'gender'=>['required'],
            'address'=>['required'],
            'phone_number'=>['required', 'integer'],
            'current_work'=>['required'],
            'year_graduated'=>['required'],
            'motto'=>['required'],
            'nickname' => ['required'], 

        ])->validate();
        
        $user_details = array(
            'course_id'=>$input['course_id'],
            'date_of_birth'=>$input['date_of_birth'], 
            'religion'=>$input['religion'], 
            'civil_status'=>$input['civil_status'], 
            'gender'=>$input['gender'], 
            'address'=>$input['address'], 
            'phone_number'=>$input['phone_number'], 
            'current_work'=>$input['current_work'], 
            'year_graduated'=>$input['year_graduated'], 
            'motto'=>$input['motto'], 
            'nickname'=>$input['nickname']);
            
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'status' => 'pending',
            'user_type' => 'student',
            'college_id' => $input['college_id'],
            'college_id' => $input['course_id'],
            'details' => $user_details,
        ]);

        //insert notification for new registrating users
        Notification::create([
            'user_id' => $user->id,
            'title' => 'New user registration',
            'user_type' => 'staff_admin',
            'content' => 'User '.$user->name.' is pending for approval',
            'is_processed' => false
        ]);
        return Redirect::route('login');
    }

    public function registerAction(Request $request)
    {
        $notification = Notification::find($request->notification_id);
        $user = User::find($request->user_id);
        if ($request->action == 'approve') {
            switch (Auth::user()->user_type) {
                case 'admin':
                    $user->update([
                        'status' => 'active'
                    ]);
                    $notification->update([
                        'is_processed' => true
                    ]);
                    break;
                case 'staff_admin':
                    $user->update([
                        'status' => 'admin_pending'
                    ]);
                    $notification->update([
                        'user_type' => 'admin'
                    ]);
                    break;
                default: //student
                    dd('Something went wrong');
                    break;
            }
        } else { //rejected
            $user->update([
                'status' => 'rejected'
            ]);
        }

        return Redirect::back();
    }
}
