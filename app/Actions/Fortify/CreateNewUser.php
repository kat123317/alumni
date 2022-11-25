<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
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
            'phone_number'=>['required','integer'],
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
            
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'status' => 'pending',
            'user_type' => 'student',
            'college_id' => $input['college_id'],
            'course_id' => $input['course_id'],
            'details' => $user_details,
        ]);
    }
}
