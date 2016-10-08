<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('account_id')->unsigned()->nullable()->default(NULL);
            $table->enum('status', ['active', 'inactive']);
            $table->enum('role', ['super_admin', 'admin', 'manager', 'staff']);
            $table->string('phone', 25);

            $table->foreign('account_id','users_account_FK')->references('id')->on('accounts')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_account_FK');
        });
    }
}
