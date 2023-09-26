<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Manually define and insert 10 user records
        User::create([
            'name' => 'Student 1',
            'email' => 'student@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 2',
            'email' => 'student2@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 3',
            'email' => 'student3@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 4',
            'email' => 'student4@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 5',
            'email' => 'student5@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 6',
            'email' => 'student6@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 7',
            'email' => 'student7@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 8',
            'email' => 'student8@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 9',
            'email' => 'student9@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'Student 10',
            'email' => 'student10@gmail.com',
            'password' => bcrypt(12345678),
        ]);
    }
}
