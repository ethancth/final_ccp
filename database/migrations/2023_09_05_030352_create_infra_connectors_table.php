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
        Schema::create('infra_connectors', function (Blueprint $table) {
            $table->id();
            $table->string('company_id');
            $table->string('display_name')->nullable();
            $table->string('server_address')->nullable();
            $table->string('credential')->nullable();
            $table->string('connection_status')->nullable();
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
        Schema::dropIfExists('infra_connectors');
    }
};
