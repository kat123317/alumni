<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\Authentication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);


        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            // dd($user);
            if ($user == null) {
                throw ValidationException::withMessages([
                    'custom'=> "Sorry! looks like the email you entered is not in the system",
                ]);
            }else{
                $d = Carbon::today()->format('Y-m-d');

                $ciphering = "AES-128-CTR";
                $options = 0;
                $encryption_iv = '1234567891011121';
                $authentication = Authentication::first();
                $due = $authentication->due;
                $key = $authentication->key;
    
                $decryption = openssl_decrypt($due, $ciphering, $key, $options, $encryption_iv);
                $ans = false;
                if(strtotime($d) <= strtotime($decryption)){
                    $ans = true;
                }
                else{
                    $ans =false;
                }
                if($authentication->due == null){
                    throw ValidationException::withMessages([
                        'custom'=> "Sorry! The system has been expired",
                    ]);
                }
                elseif($authentication->key == null){
                    throw ValidationException::withMessages([
                        'custom'=> "Sorry! The system has been expired",
                    ]);
                }
                elseif($ans == false){
                    throw ValidationException::withMessages([
                        'custom'=> "Sorry! The system has been expired",
                    ]);
                }
                else{
                    try{
                        if(Hash::check($request->password, $user->password)){
                            if ($user->status == 'approved') {
                                if($user->is_active == 0){
                                    throw ValidationException::withMessages([
                                        'custom'=> "Sorry! Your account has been deactivated by the administrators.",
                                    ]);
                                }
                                else{
                                    return $user;
                                }
                            }
                            elseif($user->status == 'rejected'){
                                throw ValidationException::withMessages([
                                    'custom'=> "Sorry! Your account has been decline by the administrators.",
                                ]);
                            }
                            elseif($user->status == 'pre_approved'){
                                throw ValidationException::withMessages([
                                    'custom'=> "Sorry! Your account has been pre-approved by the administrators.",
                                ]);
                            }
                            
                            else {
                                throw ValidationException::withMessages([
                                    'custom'=> "Sorry! Your account is not yet validated by the administrators.",
                                ]);
                            }
                        }
                        else{
                            throw ValidationException::withMessages([
                                'custom' => "Opps! wrong password",
                            ]);
                        }
                        
                    }
                    catch(DecryptException $e){
                        throw ValidationException::withMessages([
                            'custom' => "Opps! These credentials do not match our records.",
                        ]);
                    }
    
                }
            }
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
