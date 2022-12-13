<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthenticationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authentications')->insert([
            'due' => 'MBk5iG9DOa8+Iw==',
            'key' => 'H1SrrdR/9HYJz+jvHBI=',
            'secret_code' => '12345',
            ]);
    }
}
