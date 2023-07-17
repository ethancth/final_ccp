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
        Schema::create('project_firewall_ports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_firewall_id')->unsigned();
            $table->string('port');
            $table->string('is_all_port')->default(0);
            $table->string('port_ref_id');
            $table->string('display_port_type');
            $table->string('protocol');
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
        Schema::dropIfExists('project_firewall_ports');
    }
};
