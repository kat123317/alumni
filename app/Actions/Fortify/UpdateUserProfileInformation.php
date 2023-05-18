<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],

            'course_id' => ['required', 'integer'],
            'date_of_birth' => ['required', 'date'],
            'religion'=>['required', 'string'],
            'civil_status'=>['required'],
            'gender'=>['required'],
            'address'=>['required'],
            'phone_number'=>['required'],
            'telephone_number'=>['required'],
            'current_work'=>['required'],
            'year_graduated'=>['required'],
            'motto'=>['required'],
            'nickname' => ['required'], 
            'region_of_origin' => ['required'], 
            'province' => ['required'], 
            'degree_graduated' => ['required'], 
            
        ])->validateWithBag('updateProfileInformation');


        $user_details = array(
            'course_id'=>$input['course_id'],
            'date_of_birth'=>$input['date_of_birth'], 
            'religion'=>$input['religion'], 
            'civil_status'=>$input['civil_status'], 
            'gender'=>$input['gender'], 
            'address'=>$input['address'], 
            'phone_number'=>$input['phone_number'], 
            'telephone_number'=>$input['telephone_number'], 
            'current_work'=>$input['current_work'], 
            'year_graduated'=>$input['year_graduated'], 
            'motto'=>$input['motto'], 
            'nickname'=>$input['nickname'],
            'region_of_origin'=>$input['region_of_origin'],
            'province'=>$input['province'],
            'degree_graduated'=>$input['degree_graduated'],
            'honors_awards'=>$input['honors_awards']??[],
            'professional_examination'=>$input['professional_examination'],
            
        );

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'fname' => $input['fname'],
                'mname' => $input['mname'],
                'lname' => $input['lname'],
                'name' => $input['fname'].' '.$input['mname'].' '.$input['lname'],
                'email' => $input['email'],
                'details' => $user_details,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'fname' => $input['fname'],
                'mname' => $input['mname'],
                'lname' => $input['lname'],
                'name' => $input['fname'].' '.$input['mname'].' '.$input['lname'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
