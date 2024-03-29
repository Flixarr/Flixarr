<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultSettings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'app_name',
                'value' => 'Flixarr',
            ],
            [
                'key' => 'app_url',
                'value' => '/',
            ],
            [
                'key' => 'setup_completed',
                'value' => false,
            ],
            [
                'key' => 'setup_plex_auth_completed',
                'value' => false,
            ],
            [
                'key' => 'setup_plex_server_completed',
                'value' => false,
            ],
        ]);
    }
}
