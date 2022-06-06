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
        Schema::create('datastores', function (Blueprint $table) {
            $table->id();
            $table->string('host_id')->nullable();
            $table->string('host_name')->nullable();
            $table->string('ds_id')->nullable();
            $table->string('ds_name')->nullable();
            $table->decimal('ds_freespace',10,2)->nullable();
            $table->decimal('ds_uncommitted',10,2)->nullable();
            $table->decimal('ds_capacity',10,2)->nullable();
            $table->string('ds_multiple_host')->nullable();
            $table->string('ds_accessible')->nullable();
            $table->string('ds_overall_status')->nullable();
            $table->string('ds_type')->nullable();
            $table->integer('sync_status')->default(1)->nullable();
            $table->timestamps();
            $table->integer('cost_profile_id')->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datastores');
    }
};
