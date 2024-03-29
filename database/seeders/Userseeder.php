<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            "name"=>"admin",
            "email"=>"admin@admin.com",
            "password"=>bcrypt("password"),
        ]);
    }
}
