<?php

namespace App\Providers;

use App\Models\Authentication;
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

        $d = Carbon::today()->format('Y-m-d');
        return;
        $ciphering = "AES-128-CTR";
        $options = 0;
        $encryption_iv = '1234567891011121';
        $authentication = Authentication::first();
        $due = $authentication->due;
        $key = $authentication->key;
        //  $due = '2024-01-01';
        // $key_to_encrypt = 'H1SrrdR/9HYJz+jvHBI=';
        // $key = 'weakprogrammer';
        // $encryption = openssl_encrypt($key_to_encrypt, $ciphering, $key, $options, $encryption_iv);

        $decryption = openssl_decrypt($due, $ciphering, $key, $options, $encryption_iv);
        // dd($decryption);
        // dd(strtotime($d) <= strtotime($decryption));
        $ans = false;
        if (strtotime($decryption) >= strtotime($d)) {
            $ans = true;
        } else {
            $ans = false;
        }


        if ($authentication->due == null) {
            Auth::logout();
        } elseif ($authentication->key == null) {
            Auth::logout();
        } elseif ($ans == true) {
            Auth::logout();
        }

        // else{
        //     // return route('welcome');
        //     // return redirect('welcome')->with(Auth::logout());
        //     // header("Location: ".env('APP_URL'));
        //     Auth::logout();

        // }
    }
}
