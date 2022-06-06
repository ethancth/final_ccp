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
        Schema::create('datastore_cost_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('vstorage');
            $table->string('vstorage_unit')->comment("GB/TB");
            $table->decimal('vstorage_price', 10, 2);
            $table->integer('created_by')->comment("create by");
            $table->decimal('h_vstorage_price',10,2)->nullable();
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
        Schema::dropIfExists('datastore_cost_profiles');
    }
};
