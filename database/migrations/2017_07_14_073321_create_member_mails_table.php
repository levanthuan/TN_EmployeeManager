<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->string('time_start');
            $table->string('time_end');
            $table->enum('admin_status', array('seen', 'unseen'));
            $table->enum('status', array('done', 'none', 'div_done', 'team_done'));
            $table->string('reason');
            $table->string('time_send');
            $table->integer('users_id');            
            $table->rememberToken();
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
        Schema::dropIfExists('member_mails');
    }
}
