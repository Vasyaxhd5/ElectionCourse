<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $findRole = DB::table('roles')
            ->where('name', '=', 'Admin')->first();
        if(!$findRole) {
            $admin = new Role();
            $admin->name = 'Admin';
            $admin->save();
        }


        $findRole = DB::table('roles')
            ->where('name', '=', 'User')->first();
        if(!$findRole) {
            $user = new Role();
            $user->name = 'User';
            $user->save();
        }
    }
}
