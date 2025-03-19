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
            'name'      => 'Dani Sofyan',
            'email'     => 'dani@codelogy.dev',
            'password'  => bcrypt('123qweasd'),
            'email_verified_at' => now()
        ]);
    }
}
