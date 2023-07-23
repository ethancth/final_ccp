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
        Schema::table('project_server_firewalls', function (Blueprint $table) {
            //
            $table->string('source_source_custom_ip')->nullable();
            $table->string('source_source_custom_vm')->nullable();
            $table->string('source_source_custom_sg')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_server_firewalls', function (Blueprint $table) {
            //
            $table->dropColumn('source_source_custom_ip');
            $table->dropColumn('source_source_custom_vm');
            $table->dropColumn('source_source_custom_sg');
        });
    }
};
