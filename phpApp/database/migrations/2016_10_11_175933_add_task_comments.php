<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment', 45);
            $table->integer('task_id')->unsigned()->nullable()->default(NULL);
            $table->integer('user_id')->unsigned()->nullable()->default(NULL);
            $table->timestamps();

            $table->foreign('user_id', 'task_comment_owner_user_FK')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id', 'comment_task_FK')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_comments', function (Blueprint $table) {
            $table->dropForeign('task_comment_owner_user_FK');
            $table->dropForeign('comment_task_FK');
        });

        Schema::dropIfExists('task_comments');
    }
}
