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
            $table->string('provision_status')->default('pending');
            $table->string('provision_note')->nullable();
            $table->string('provision_vra_workflow_id')->nullable();
            $table->timestamp('provision_datetime')->nullable();
            $table->string('business_unit')->nullable()->after('environment');
            $table->string('display_business_unit')->nullable()->after('display_os');
            $table->string('system_type')->nullable()->after('business_unit');
            $table->string('display_system_type')->nullable()->after('display_business_unit');
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
            $table->dropColumn('provision_status');
            $table->dropColumn('provision_note');
            $table->dropColumn('provision_vra_workflow_id');
            $table->dropColumn('provision_datetime');
            $table->dropColumn('business_unit');
            $table->dropColumn('display_business_unit');
            $table->dropColumn('system_type');
            $table->dropColumn('display_system_type');
            //
        });
    }
};
