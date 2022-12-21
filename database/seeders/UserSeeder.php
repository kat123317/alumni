<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_details = array (
            'motto' => 'Patience is a virtue',
            'gender' => '1',
            'address' => 'University Town',
            'nickname' => 'Super Administrator',
            'province' => 'Maramag',
            'religion' => 'CMU',
            'course_id' => '1',
            'civil_status' => '1',
            'current_work' => 'Administrator',
            'phone_number' => '123456789',
            'date_of_birth' => '2022-10-20',
            'honors_awards' => 
            array (
            ),
            'year_graduated' => '1900',
            'degree_graduated' => '1',
            'region_of_origin' => 'Bukidnon',
            'professional_examination' => 'None',
        );
        $staff_admin_details = array (
            'motto' => 'Patience is a virtue',
            'gender' => '1',
            'address' => 'University Town',
            'nickname' => 'Staff Administrator',
            'province' => 'Maramag',
            'religion' => 'CMU',
            'course_id' => '1',
            'civil_status' => '1',
            'current_work' => 'Staff Administrator',
            'phone_number' => '123456789',
            'date_of_birth' => '2022-10-20',
            'honors_awards' => 
            array (
            ),
            'year_graduated' => '1900',
            'degree_graduated' => '1',
            'region_of_origin' => 'Bukidnon',
            'professional_examination' => 'None',
        );
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'administrator@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'approved',
            'user_type' => 'admin',
            'college_id' => 1,
            'course_id' => 1,
            'details' => json_encode($admin_details),
            'is_active' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'Staff Admin',
            'email' => 'staffadministrator@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 'approved',
            'user_type' => 'staff_admin',
            'college_id' => 1,
            'course_id' => 1,
            'details' => json_encode($staff_admin_details),
            'is_active' => 1,
        ]);
    }
}