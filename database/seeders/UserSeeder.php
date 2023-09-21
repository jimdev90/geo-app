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
            "name" => "S3 JIMMY PAYTAN",
            "cip" => 31999873,
            "email" => "jimmy@correo.com",
            "password" => bcrypt("123456789")
        ]);
    }
}
