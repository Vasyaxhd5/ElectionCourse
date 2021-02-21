<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = DB::table('users')
            ->where('email', '=', 'vasyaxhd5@gmail.com')->first();
        if ($user) {
            $findUserRole = DB::table('role_user')
                ->where('user_id', '=', $user->id)->first();

            if (!$findUserRole) {
                $admin = User::where('email', '=', 'vasyaxhd5@gmail.com')->firstOrFail();
                $adminRole = Role::where('name', '=', 'Admin')->firstOrFail();

                $admin->roles()->attach($adminRole);
            }

        }
    }
}
