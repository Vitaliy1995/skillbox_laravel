<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AddRoleForUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Role::insert([
            ['name' => 'ADMIN'],
            ['name' => 'BASE'],
        ]);

        $fUser = User::find(1);
        if (is_null($fUser)) {
            $fUser = User::create([
                'name' => 'Admin',
                'email' => config('mail.admin_mail'),
                'password' => Hash::make('Qwerty12')
            ]);
        }

        $fUser->roles()->attach(\App\Role::ADMIN);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::find(1)->roles()->detach(\App\Role::ADMIN);
        \App\Role::truncate();
    }
}
