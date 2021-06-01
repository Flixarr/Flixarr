<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlexServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plex_servers', function (Blueprint $table) {
            $table->id();
            $table->string('server_id')->nullable();
            $table->string('name')->nullable();
            $table->string('host');
            $table->string('port');
            $table->string('scheme');
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
        Schema::dropIfExists('plex_servers');
    }
}
