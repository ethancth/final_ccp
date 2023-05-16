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
        Schema::create('project_firewalls', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('firewall_name');
            $table->string('firewall_uuid')->nullable();
            $table->string('source')->nullable();
            $table->string('source_type')->nullable();
            $table->string('destination_id')->nullable();
            $table->string('destination_name')->nullable();
            $table->string('port')->nullable();
            $table->string('is_custom_port')->nullable();
            $table->string('status')->default('1')->nullable();
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
        Schema::dropIfExists('project_firewalls');
    }
};
