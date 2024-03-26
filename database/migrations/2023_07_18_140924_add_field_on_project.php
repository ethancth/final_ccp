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
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->string('total_cpu')->nullable()->default('0');
            $table->string('total_memory')->nullable()->default('0');
            $table->string('total_storage')->nullable()->default('0');
            $table->string('total_server')->nullable()->default('0');
            $table->string('total_server_on')->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('total_cpu');
            $table->dropColumn('total_memory');
            $table->dropColumn('total_storage');
            $table->dropColumn('total_server');
            $table->dropColumn('total_server_on');
        });
    }
};
