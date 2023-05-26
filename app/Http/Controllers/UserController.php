<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Authentication;
use App\Models\Graduate;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            // 'status' => ['required', 'string', 'max:255'],
            // 'user_type' => ['required', 'string', 'max:255'],
            'college_id' => ['required', 'integer'],
            'course_id' => ['required', 'integer'],
            
            // 'date_of_birth' => ['required', 'date'],
            
            // 'religion'=>['required', 'string'],
            // 'civil_status'=>['required'],
            // 'gender'=>['required'],

            'address'=>['required', 'string'],

            // 'phone_number'=>['required', 'integer'],
            // 'telephone_number'=>['required', 'integer'],

            // 'current_work'=>['required'],
            'year_graduated'=>['required'],
            // 'motto'=>['required'],
            // 'nickname' => ['required'], 
            'region_of_origin'=> ['required', 'string'],
            'province'=> ['required', 'string'],
            'degree_graduated' => ['required'],
            'photos' => ['required'],

        ])->validate();
        

        $images = array();
        if($request->hasfile('photos')){
            foreach($request->file('photos') as $photo){
                $imageName = Str::random(40).'.'.$photo->extension();
                $photo->move(public_path().'/images/verification/', $imageName); 
                array_push($images, $imageName);
            }
        }

        $user_details = array(
            //personal info
            'address'=>$input['address'], 
            'phone_number'=>$input['phone_number'], 
            'telephone_number'=>$input['telephone_number'], 
            'civil_status'=>$input['civil_status'], 
            'gender'=>$input['gender'], 
            'date_of_birth'=>$input['date_of_birth'], 
            'region_of_origin'=>$input['region_of_origin'],
            'province'=>$input['province'],
            'religion'=>$input['religion'], 
            //educational info
            'degree_graduated'=> $input['degree_graduated'],
            'course_id'=>$input['course_id'],
            'honors_awards'=>$input['honors_awards']??[],
            'professional_examination'=>$input['professional_examination'],
            'current_work'=>$input['current_work'], 
            'year_graduated'=>$input['year_graduated'], 
            'motto'=>$input['motto']??'', 
            'nickname'=>$input['nickname']??'',
            'photos'=> $images??[]
        );

        $graduate = DB::table('graduates')->where('firstname',$input['fname'])->where('middlename',$input['mname'])->where('lastname',$input['lname'])->where('user_id', null)->first();
        // dd($graduate);

        if($graduate != null){
            $user = User::create([
                'fname' => $input['fname'],
                'mname' => $input['mname'],
                'lname' => $input['lname'],
                'name' => $input['fname'].' '.$input['mname'].' '.$input['lname'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'status' => 'approved',
                'user_type' => 'alumni',
                'college_id' => $input['college_id'],
                'course_id' => $input['course_id'],
                'details' => $user_details,
                'is_active' => 1,
            ]);
            $graduate_to_update = Graduate::find($graduate->id);
            $graduate_to_update -> update([
                'user_id' => $user->id
            ]);
            return Inertia::render('Auth/Register', [
                'message_notification' => 'You may login your account now.'
            ]);
        }
        else{
            $user = User::create([
                'fname' => $input['fname'],
                'mname' => $input['mname'],
                'lname' => $input['lname'],
                'name' => $input['fname'].' '.$input['mname'].' '.$input['lname'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'status' => 'pending',
                'user_type' => 'alumni',
                'college_id' => $input['college_id'],
                'course_id' => $input['course_id'],
                'details' => $user_details,
                'is_active' => 0,
            ]);
    
            //insert notification for new registrating users
            Notification::create([
                'user_id' => $user->id,
                'title' => 'New user registration',
                'user_type' => 'staff_admin',
                'content' => 'User '.$user->name.' is pending for approval',
                'is_processed' => false
            ]);
            // return Redirect::route('login');

            return Inertia::render('Auth/Register', [
                'message_notification' => 'Your registration will be verified by the admin, wait for the confirmation on your respected
                email. Make sure that the email you use for the registration is active.'
            ]);
        }
    }

    public function deactivate_user(Request $request, $id){
        $user = User::find($id);
        $user -> update([
            'is_active'=>false
        ]);
        return Redirect::back();
    }

    public function activate_user(Request $request, $id){
        $user = User::find($id);
        $user -> update([
            'is_active'=>true
        ]);
        return Redirect::back();
    }

    public function assign_as_admin(Request $request, $id){
        $user = User::find($id);
        $user -> update([
            'user_type'=> 'staff_admin'
        ]);
        return Redirect::back();
    }

    public function update_expire(Request $request){
     
        $expire = Authentication::where('secret_code', $request->code)->first();
        // dd($expire);
        if ($expire == null) {
            throw ValidationException::withMessages([
                'expire_error'=> "Opps! Secret code do not match our records.",
            ]);
        }
        else{
            $expire -> update([
                'due'=> $request->new_due,
                'key' => $request->new_key
            ]);
        }
       
        return Redirect::back();
    }

    public function remove_as_admin(Request $request, $id){
        $user = User::find($id);
        $user -> update([
            'user_type'=> 'alumni'
        ]);
        return Redirect::back();
    }

    public function registerAction(Request $request)
    {
        $notification = Notification::find($request->notification_id);
        $user = User::find($request->user_id);
        if ($request->action == 'approve') {
            $user->update([
                'status' => 'approved',
                'details->staff_approved_by' => Auth::user()->name,
                'details->admin_approved_by' => Auth::user()->name,
                'is_active' => true
            ]);
            $notification->update([
                'is_processed' => true
            ]);
            try {
                Mail::to($user->email)->send(new RegisterMail($user->email));
            } catch (\Throwable $th) {
                //throw $th;
            }
            /* switch (Auth::user()->user_type) {
                case 'admin':
                    $user->update([
                        'status' => 'approved',
                        'details->admin_approved_by' => Auth::user()->name,
                        'is_active' => true
                    ]);
                    $notification->update([
                        'is_processed' => true
                    ]);
                    Mail::to($user->email)->send(new RegisterMail($user->email));
                    break;
                case 'staff_admin':
                case 'admin':
                    $user->update([
                        'status' => 'approved',
                        'details->staff_approved_by' => Auth::user()->name,
                    ]);
                    $notification->update([
                        'user_type' => 'admin'
                    ]);
                    break;
                default: //student
                    dd('Something went wrong');
                    break;
            } */
        } else { //rejected
            $user->update([
                'status' => 'rejected',
                'details->rejected_by' => Auth::user()->name
            ]);
            $notification->update([
                'is_processed' => true
            ]);
        }
        return Redirect::back();
    }
}
