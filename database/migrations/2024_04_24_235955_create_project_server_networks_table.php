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
        Schema::create('project_server_networks', function (Blueprint $table) {
            $table->id();
            $table->string('server_id');
            $table->string('created_by')->nullable();
            $table->longText('network_name')->nullable();
            $table->longText('network_ip')->nullable();
            $table->longText('network_gateway')->nullable();
            $table->longText('network_subnet')->nullable();
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
        Schema::dropIfExists('project_server_networks');
    }
};
