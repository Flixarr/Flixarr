<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('id');
            $table->integer('tmdb_id');
            $table->integer('downloader_id')->nullable();
            $table->string('media_type');
            $table->string('title')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->string('poster_path')->nullable();
            $table->boolean('is_available')->default(0);
            $table->string('status')->default('requested');
            $table->integer('user_id');

            // $table->id('primary_key');
            // $table->integer('tmdb_id')->nullable();
            // $table->string('media_type')->nullable();
            // $table->string('title')->nullable();
            // $table->string('backdrop_path')->nullable();
            // $table->string('poster_path')->nullable();
            // $table->json('genre_ids')->nullable();
            // $table->longText('overview')->nullable();
            // $table->integer('runtime')->nullable();
            // $table->string('release_date')->nullable();
            // $table->json('belongs_to_collection')->nullable();
            // $table->json('credits')->nullable();
            // $table->json('videos')->nullable();
            // $table->string('status')->nullable();

            // $table->string('downloader_id');
            // $table->string('tmdb_id');
            // $table->string('media_type');
            // $table->string('status')->default('requested');

            // $table->boolean('adult')->nullable();
            // $table->integer('budget')->nullable();
            // $table->string('homepage')->nullable();
            // $table->string('imdb_id')->nullable();
            // $table->string('original_language')->nullable();
            // $table->string('original_title')->nullable();
            // $table->string('popularity')->nullable();
            // $table->json('production_companies')->nullable();
            // $table->json('production_countries')->nullable();
            // $table->integer('revenue')->nullable();
            // $table->json('spoken_languages')->nullable();
            // $table->string('tagline')->nullable();
            // $table->boolean('video')->nullable();
            // $table->string('vote_average')->nullable();
            // $table->integer('vote_count')->nullable();
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
        Schema::dropIfExists('media');
    }
}
