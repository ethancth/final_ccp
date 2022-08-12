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
        Schema::table('project_servers', function (Blueprint $table) {
            //
            $table->string('mandatory_sa_field')->nullable();
            $table->string('optional_sa_field')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('server', function (Blueprint $table) {
            //
            $table->dropColumn('mandatory_sa_field');
            $table->dropColumn('optional_sa_field');
        });
    }
};
