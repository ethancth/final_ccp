<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_members', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('department_members', function (Blueprint $table) {
            $table->dropForeign('department_members_user_id_foreign');
            //$table->dropColumn(['department_id']);
            $table->dropColumn('user_id');

            //
        });
    }
};
