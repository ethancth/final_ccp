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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name', 100);
            $table->string('hod_id')->nullable();
            $table->timestamps();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->integer('department_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->boolean('disabled')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
