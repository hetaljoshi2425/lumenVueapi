<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'John';
        $user->email = 'john_example@gmail.com';
        $user->dob = date('d-m-y h:i:s');
        $user->color = '#FF0000';
        $user->save();
    }
}
