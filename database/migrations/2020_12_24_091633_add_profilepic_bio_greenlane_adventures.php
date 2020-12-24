<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilepicBioGreenlaneAdventures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('profilepic'); 
            $table->text('bio');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'profilepic')) {
            Schema::table('users', function(Blueprint $table) {
                $table->dropColumn('profilepic');
            });
        }
        if (Schema::hasColumn('users', 'bio')) {
            Schema::table('users', function(Blueprint $table) {
                $table->dropColumn('bio');
            });
        }
    }
}
