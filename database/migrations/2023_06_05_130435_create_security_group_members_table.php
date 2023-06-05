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
        Schema::create('security_group_members', function (Blueprint $table) {
            $table->unsignedBigInteger('project_security_group_env_id')->unsigned();
            $table->unsignedBigInteger('project_server_id')->unsigned();
            $table->foreign('project_security_group_env_id')->references('id')->on('project_security_group_envs')->onDelete('cascade');
            $table->foreign('project_server_id')->references('id')->on('project_servers')->onDelete('cascade');
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
        Schema::dropIfExists('security_group_members');
    }
};
