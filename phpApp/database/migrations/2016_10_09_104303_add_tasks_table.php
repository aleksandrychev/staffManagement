<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 75);
            $table->string('description', 450)->nullable();
            $table->integer('implementer_id')->unsigned()->nullable()->default(NULL);
            $table->integer('user_id')->unsigned()->nullable()->default(NULL);
            $table->integer('account_id')->unsigned()->nullable()->default(NULL);
            $table->enum('status', ['new', 'in_process', 'finished', 'canceled'])->default('new');
            $table->timestamps();

            $table->foreign('implementer_id', 'task_implementer_user_FK')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id', 'task_owner_user_FK')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('account_id', 'task_account_user_FK')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('task_implementer_user_FK');
            $table->dropForeign('task_owner_user_FK');
            $table->dropForeign('task_account_user_FK');
        });

        Schema::dropIfExists('tasks');

    }
}
