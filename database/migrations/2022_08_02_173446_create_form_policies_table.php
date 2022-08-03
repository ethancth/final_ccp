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
        Schema::create('form_policies', function (Blueprint $table) {
            $table->id();
            $table->string('env_field')->nullable();
            $table->string('tier_field')->nullable();
            $table->string('os_field')->nullable();
            $table->string('mandatory_field')->nullable();
            $table->string('optional_field')->nullable();
            $table->integer('company_id');
            $table->integer('status')->default('1');
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
        Schema::dropIfExists('form_policies');
    }
};
