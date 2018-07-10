<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function($table)
        {
            DB::statement('ALTER TABLE teams MODIFY COLUMN leader_id INTEGER NULL');
            DB::statement('ALTER TABLE teams MODIFY COLUMN divisions_id INTEGER NULL');
        });         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
