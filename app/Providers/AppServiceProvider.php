<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        date_default_timezone_set('Asia/Manila');
        $date1 = Crypt::encryptString(Carbon::today()->format('Y-m-d'));
        $date2 = Crypt::decryptString($date1);

        $ciphering = "AES-128-CTR";
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = "weakprogrammer";
        $encryption = openssl_encrypt($date2, $ciphering, $encryption_key, $options, $encryption_iv);

        $decryption = openssl_decrypt($encryption, $ciphering, $encryption_key, $options, $encryption_iv);
        
        $ans = false;
        if($decryption >= $date2){
            $ans = true;
        }
        elseif ($decryption == $date2) {
            $ans =false;
        }
        if($ans == false){
            
            Auth::logout();
            // header("Location: ".env('APP_URL').'/login?status=expired');
        }
    }
}
