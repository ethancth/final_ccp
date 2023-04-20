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
        Schema::table('project_servers', function (Blueprint $table) {
            //
            $table->string('is_vm_provision')->default('0');
            $table->string('vm_power_status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_servers', function (Blueprint $table) {
            //
            $table->dropColumn('is_vm_provision');
            $table->dropColumn('vm_power_status');
        });
    }
};
