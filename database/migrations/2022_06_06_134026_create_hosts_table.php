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
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->string('host_name')->nullable();
            $table->string('host_id')->nullable();
            $table->string('cluster_name')->nullable();
            $table->string('cluster_id')->nullable();
            $table->string('cpuMhz')->nullable();
            $table->string('numCpuPkgs')->nullable();
            $table->string('numCpuCores')->nullable();
            $table->string('numCpuThreads')->nullable();
            $table->string('memorySize')->nullable();
            $table->string('numNics')->nullable();
            $table->string('cpuModel')->nullable();
            $table->integer('sync_status')->default(1)->nullable();
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
        Schema::dropIfExists('hosts');
    }
};
