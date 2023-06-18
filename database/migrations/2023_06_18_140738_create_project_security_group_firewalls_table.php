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
        Schema::create('project_security_group_firewalls', function (Blueprint $table) {
            $table->id();
            $table->string('security_env_id');
            $table->string('firewall_name');
            $table->string('firewall_uuid')->nullable();
            $table->string('source')->nullable();
            $table->string('source_type')->nullable();
            $table->string('destination_id')->nullable();
            $table->string('destination_name')->nullable();
            $table->string('port')->nullable();
            $table->string('port_array')->nullable();
            $table->string('is_custom_port')->nullable();
            $table->string('status')->default('1')->nullable();
            $table->string('display_source_custom_ip')->nullable();
            $table->string('display_source_custom_vm')->nullable();
            $table->string('display_source_custom_sg')->nullable();
            $table->string('display_destination')->nullable();
            $table->string('display_port')->nullable();
            $table->string('editable')->default('1')->comment('0 is no editable');
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
        Schema::dropIfExists('project_security_group_firewalls');
    }
};
