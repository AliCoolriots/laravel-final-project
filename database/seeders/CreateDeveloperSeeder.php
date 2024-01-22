<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Developer;

class CreateDeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $developers = [
            [
                'name'=>'Alex Thompson',
                'email'=>'developer1@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'developer'
            ],
            [
                'name'=>'Jessica Chen',
                'email'=>'developer2@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'developer'
            ],
            [
                'name'=>'Ryan Patel',
                'email'=>'developer3@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'developer'
            ],
            [
                'name'=>'Emily Rodriguez',
                'email'=>'developer4@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'developer'
            ],
            [
                'name'=>'Tyler Nguyen',
                'email'=>'developer5@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'developer'
            ],
            [
                'name'=>'Olivia Smith',
                'email'=>'developer6@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'developer'
            ],
            [
                'name'=>'Jordan Martinez',
                'email'=>'developer7@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'developer'
            ],
            [
                'name'=>'Ethan Kim',
                'email'=>'developer8@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'developer'
            ],
            ];   
            
            foreach ($developers as $developer) {
                $actualDeveloper =  Developer::create([
                    'name' => $developer['name'],
                ]);

                User::create([
                    'name' => $developer['name'],
                    'email' => $developer['email'],
                    'password' => $developer['password'],
                    'role' => 'developer',
                    'user_id' => $actualDeveloper->id,
                ]);
            }
               
    }
}
