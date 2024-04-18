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
            $table->string('project_type');
            $table->boolean('capacity_check')->default(false);
            $table->string('capacity_note')->nullable();
            $table->boolean('license_check')->default(false);
            $table->string('license_note')->nullable();
            $table->boolean('work_order_check')->default(false);
            $table->string('work_order_note')->nullable();
            //
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
            //
            $table->dropColumn('project_type');
            $table->dropColumn('capacity_check');
            $table->dropColumn('capacity_note');
            $table->dropColumn('license_check');
            $table->dropColumn('license_note');
            $table->dropColumn('work_order_check');
            $table->dropColumn('work_order_note');
        });
    }
};
