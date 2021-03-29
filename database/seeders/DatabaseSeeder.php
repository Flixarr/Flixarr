<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Marc',
            'last_name' => 'Hershey',
            'email' => env('ADMIN_EMAIL'),
            'password' => Hash::make(env('ADMIN_PASS')),
            'require_password' => 0,
            'setup' => 1,
            'plex_id' => env('ADMIN_PLEX_ID'),
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('user_settings')->insert([
            'user_id' => 1,
        ]);

        DB::table('settings')->insert([
            'key' => 'setup_completed',
            'value' => false,
        ]);
    }
}
