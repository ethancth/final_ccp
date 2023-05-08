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
        Schema::create('project_security_group_env_firewalls', function (Blueprint $table) {
            $table->id();
            $table->string('security_env_id');
            $table->string('security_id')->nullable();
            $table->string('name')->nullable();
            $table->string('source')->nullable();
            $table->string('destination')->nullable();
            $table->string('port')->nullable();
            $table->string('protocol')->nullable();
            $table->string('rule')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('project_security_group_env_firewalls');
    }
};
