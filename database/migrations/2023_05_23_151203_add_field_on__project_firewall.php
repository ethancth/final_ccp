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
        Schema::table('project_firewalls', function (Blueprint $table) {
            //
            $table->string('display_source_custom_ip')->nullable();
            $table->string('display_source_custom_vm')->nullable();
            $table->string('display_source_custom_sg')->nullable();
            $table->string('display_destination')->nullable();
            $table->string('display_port')->nullable();
            $table->string('editable')->default('1')->comment('0 is no editable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_firewalls', function (Blueprint $table) {
            //
            $table->dropColumn('display_source_custom_vm');
            $table->dropColumn('display_source_custom_sg');
            $table->dropColumn('display_source_custom_ip');
            $table->dropColumn('display_destination');
            $table->dropColumn('display_port');
            $table->dropColumn('editable');
        });
    }
};
