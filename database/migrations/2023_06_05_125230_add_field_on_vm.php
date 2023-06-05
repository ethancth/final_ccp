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
            $table->string('is_vc_vm')->nullable()->default('0');
            $table->string('vc_vm_refer_id')->nullable();
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
            $table->dropColumn('is_vc_vm');
            $table->dropColumn('vc_vm_refer_id');
        });
    }
};
