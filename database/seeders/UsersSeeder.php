<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'active' => '1',
            'role' => 'SuperAdmin',
            'code' => uniqid('', false),
            'super_admin' => 1,
            'admin' => 1,
            'name' => 'José Carlos SuperAdmin',
            'email' => 'jcarneiro@professor.educacao.sp.gov.br',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //        User::create([
        //            'active' => '1',
        //            'role' => 'Admin',
        //            'code' => uniqid('', false),
        //            'super_admin' => 0,
        //            'name' => 'José Carlos Admin',
        //            'email' => 'jccarneiros@gmail.com',
        //            'email_verified_at' => now(),
        //            'password' => Hash::make('password'), // password
        //            'remember_token' => Str::random(10),
        //            'created_at' => date('Y-m-d H:i:s'),
        //            'updated_at' => date('Y-m-d H:i:s'),
        //        ]);
        //        User::create([
        //            'active' => '1',
        //            'role' => 'Professor(a)',
        //            'code' => uniqid('', false),
        //            'super_admin' => 0,
        //            'name' => 'José Carlos Teacher',
        //            'email' => 'jcarneiro@prof.educacao.sp.gov.br',
        //            'email_verified_at' => now(),
        //            'password' => Hash::make('password'), // password
        //            'remember_token' => Str::random(10),
        //            'created_at' => date('Y-m-d H:i:s'),
        //            'updated_at' => date('Y-m-d H:i:s'),
        //        ]);
        //        User::create([
        //            'active' => '1',
        //            'role' => 'Supervisão',
        //            'code' => uniqid('', false),
        //            'super_admin' => 0,
        //            'name' => 'Jacira Loureiros Supervisão',
        //            'email' => 'jaciraloureiros@gmail.com',
        //            'email_verified_at' => now(),
        //            'password' => Hash::make('password'), // password
        //            'remember_token' => Str::random(10),
        //            'created_at' => date('Y-m-d H:i:s'),
        //            'updated_at' => date('Y-m-d H:i:s'),
        //        ]);
    }
}
