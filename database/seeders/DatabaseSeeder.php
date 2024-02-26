<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        for($i = 0; $i<100; $i++){
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(6).'@gmail.com',
                'password' => Hash::make('password'),
                'role'   => 0 ,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
