<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Manager;

class CreateManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managers = [
            [
                'name'=>'Ali',
                'email'=>'manager@gmail.com',
                'password'=> bcrypt('12345678'),
                'role' => 'manager'
            ],
            ];   
            
            foreach ($managers as $manager) {
                $actualManager =  Manager::create([
                    'name' => $manager['name'],
                ]);

                User::create([
                    'name' => $manager['name'],
                    'email' => $manager['email'],
                    'password' => $manager['password'],
                    'role' => 'manager',
                    'user_id' => $actualManager->id,
                ]);
            }
    }
}
