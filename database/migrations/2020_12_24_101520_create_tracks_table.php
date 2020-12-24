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
            $table->increments('id');   //id of the track itself
            $table->integer('user_id');  //id of user that uploaded the track
            $table->string('title');
            $table->text('description');
            $table->enum('difficulty', ['easy', "medium", "hard"]);
            $table->text('image');
            $table->timestamps();
//          TODO -- several parameters as length, approx duration, location will be extracted from the gpx file using google maps api
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
