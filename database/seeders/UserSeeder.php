<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Ahmed Atef',
            'username'=>'ahmed.atef',
            'email'=>'ahmed.atef933@yahoo.com',
            'phone'=>'01003097981',
            'password'=>bcrypt('Ahmed@123'),
            'age'=>'27',
            'address'=>'address',
            'short_description'=>'desc',
            'education_degree'=>'degree',
        ]);
    }
}
