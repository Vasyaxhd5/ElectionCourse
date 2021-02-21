<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $findUser = DB::table('users')
            ->where('email', '=', 'vasyaxhd5@gmail.com')->first();
        if (!$findUser) {
            $admin = new User();
            $admin->name = 'Vasya';
            $admin->email = 'vasyaxhd5@gmail.com';
            $admin->password = bcrypt('12345678');
            $admin->save();
        }
    }
}
