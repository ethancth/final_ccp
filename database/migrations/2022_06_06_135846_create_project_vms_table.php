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
        Schema::create('project_vms', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('owner');
            $table->string('hostname');
            $table->integer('operating_system');
            $table->integer('tier');
            $table->integer('environment');
            $table->integer('v_cpu');
            $table->decimal('cpu_price',10,2)->nullable();
            $table->integer('v_memory');
            $table->decimal('memory_price',10,2)->nullable();
            $table->integer('total_storage');
            $table->decimal('storage_price',10,2)->nullable();
            $table->string('tag')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->boolean('is_delete')->default(0);
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
        Schema::dropIfExists('project_vms');
    }
};
