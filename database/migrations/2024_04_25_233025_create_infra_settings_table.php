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
        Schema::create('infra_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->nullable();
            $table->string('vra_server')->nullable();
            $table->string('vra_domain')->nullable();
            $table->string('vra_user_id')->nullable();
            $table->string('vra_credential')->nullable();
            $table->timestamp('expired_date')->nullable();
            $table->longText('refresh_token')->nullable();
            $table->longText('token')->nullable();
            $table->longText('network_workflow')->nullable();
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
        Schema::dropIfExists('infra_settings');
    }
};
