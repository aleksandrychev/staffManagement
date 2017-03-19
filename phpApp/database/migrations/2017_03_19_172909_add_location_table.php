<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned()->nullable()->default(NULL);
            $table->integer('user_id')->unsigned()->nullable()->default(NULL);
            $table->double('lat');
            $table->double('lon');
            $table->integer('speed');
            $table->timestamps();

            $table->foreign('user_id', 'staff_locations_owner_user_FK')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id', 'staff_locations_task_FK')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
