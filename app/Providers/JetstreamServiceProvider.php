<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User;
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
            // $password = 
            // dd();
            try{
                if(Hash::check($request->password, $user->password)){
                    if ($user->status == 'approved') {
                        return $user;
                    }
                    elseif($user->status == 'rejected'){
                        throw ValidationException::withMessages([
                            'custom'=> "Sorry! Your account has been decline by the administrators.",
                        ]);
                    }
                    elseif($user->status == 'pre-approved'){
                        throw ValidationException::withMessages([
                            'custom'=> "Sorry! Your account has been pre-approved by the administrators.",
                        ]);
                    }
                    elseif($user->is_active == false){
                        throw ValidationException::withMessages([
                            'custom'=> "Sorry! Your account has been deactivated by the administrators.",
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
                        'custom' => "Opps! These credentials do not match our records.",
                    ]);
                }
                
            }
            catch(DecryptException $e){
                throw ValidationException::withMessages([
                    'custom' => "Opps! These credentials do not match our records.",
                ]);
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
