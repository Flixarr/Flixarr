<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->boolean('require_password')->default(0);
            $table->boolean('setup')->default(0);
            $table->string('plex_id')->nullable();
            $table->string('plex_uuid')->nullable();
            $table->string('plex_joined_at')->nullable();
            $table->string('plex_username')->nullable();
            $table->string('plex_title')->nullable();
            $table->string('plex_thumb')->nullable();
            $table->string('plex_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
