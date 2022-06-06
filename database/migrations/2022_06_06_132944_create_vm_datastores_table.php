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
        Schema::create('vm_datastores', function (Blueprint $table) {
            $table->id();
            $table->string('vm_id')->nullable();
            $table->string('ds_id')->nullable();
            $table->string('ds_name')->nullable();
            $table->decimal('ds_unshared',10,2)->nullable();
            $table->decimal('ds_uncommitted',10,2)->nullable();
            $table->decimal('ds_committed',10,2)->nullable();
            $table->decimal('ds_price_pergb',10,2)->nullable();
            $table->decimal('ds_price',10,2)->nullable();
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
        Schema::dropIfExists('vm_datastores');
    }
};
