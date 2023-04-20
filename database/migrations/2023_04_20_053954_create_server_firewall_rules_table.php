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
        Schema::create('server_firewall_rules', function (Blueprint $table) {
            $table->id();
            $table->string('server_id');
            $table->string('type')->nullable()->comment('ssh http https');
            $table->string('protocol')->default('TCP')->comment('TCP/UDP');
            $table->string('source')->nullable();
            $table->string('destination')->nullable();
            $table->string('port')->nullable();
            $table->string('action')->nullable()->comment('allow or deny');
            $table->string('status')->default('1');
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
        Schema::dropIfExists('server_firewall_rules');
    }
};
