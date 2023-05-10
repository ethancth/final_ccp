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
        Schema::create('virtual_machines', function (Blueprint $table) {
            $table->id();
            $table->string('project_server_ref_id')->nullable()->comment('used to identify this server is from project');
            $table->string('project_ref_id')->nullable();
            $table->string('vm_object_ref_id')->nullable()->comment('vcenter vm object id');
            $table->string('cpu')->nullable();
            $table->string('memory')->nullable();
            $table->string('env')->nullable();
            $table->string('tier')->nullable();
            $table->string('cost')->nullable();
            $table->string('firewall_services')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtual_machines');
    }
};
