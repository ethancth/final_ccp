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
        Schema::create('vm_tables', function (Blueprint $table) {
            $table->id();
            $table->string('dc_id')->nullable();
            $table->string('dc_name')->nullable();
            $table->string('vm_id')->nullable();
            $table->string('vm_name')->nullable();
            $table->string('vm_cpu')->nullable();
            $table->string('vm_men')->nullable();
            $table->string('vm_os')->nullable();
            $table->string('vc_name')->nullable();
            $table->string('vc_id')->nullable();
            $table->string('host_name')->nullable();
            $table->string('host_id')->nullable();
            $table->string('cluster_name')->nullable();
            $table->string('cluster_id')->nullable();
            $table->string('power_status')->nullable();
            $table->text('boottime')->nullable();
            $table->string('is_template')->nullable();
            $table->string('vmfolder')->nullable();
            $table->string('storage_usage')->nullable();
            $table->string('committed')->nullable();
            $table->string('uncommitted')->nullable();
            $table->string('unshared')->nullable();
            $table->integer('sync_status')->default(1)->nullable();
            $table->integer('h_vcpu')->nullable();
            $table->decimal('h_vcpu_price',10,2)->nullable();
            $table->decimal('f_vcpu_price',10,2)->nullable();
            $table->integer('h_vmen')->nullable();
            $table->decimal('h_vmen_price',10,2)->nullable();
            $table->decimal('f_vmen_price',10,2)->nullable();
            $table->integer('h_vstorage')->nullable();
            $table->decimal('h_vstorage_price',10,2)->nullable();
            $table->decimal('f_vstorage_price',10,2)->nullable();
            $table->string('h_vstorage_unit')->nullable();
            $table->decimal('f_vm_cost',10,2)->nullable();
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
        Schema::dropIfExists('vm_tables');
    }
};
