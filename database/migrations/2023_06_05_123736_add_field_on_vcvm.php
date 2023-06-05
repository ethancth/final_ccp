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
        Schema::table('vc_virtual_machines', function (Blueprint $table) {
            //
            $table->string('vm_owner')->nullable();
            $table->string('project_id')->nullable();
            $table->string('assign_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vc_virtual_machines', function (Blueprint $table) {
            //
            $table->dropColumn('vm_owner');
            $table->dropColumn('project_id');
            $table->dropColumn('assign_status');
        });
    }
};
