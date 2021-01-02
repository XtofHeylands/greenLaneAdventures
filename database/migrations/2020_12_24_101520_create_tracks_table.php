<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('id');    //id of the track itself
            $table->integer('user_id');  //id of user that uploaded the track
            $table->string('title');
            $table->text('description');
            $table->enum('difficulty', ['easy', "medium", "hard"]);
            $table->text('image')->nullable();
            $table->text('gpx');
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
        Schema::dropIfExists('tracks');
    }
}
