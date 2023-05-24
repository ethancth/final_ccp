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
        Schema::create('vc_virtual_machines', function (Blueprint $table) {
            $table->id();
            $table->string('vm_object_id');
            $table->string('vm_hostname');
            $table->string('vcpu');
            $table->string('vmem');
            $table->string('vstorage');
            $table->string('power_status');
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
        Schema::dropIfExists('vc_virtual_machines');
    }
};
