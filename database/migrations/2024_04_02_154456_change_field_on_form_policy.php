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
        Schema::table('form_policies', function (Blueprint $table) {
            //
            $table->text('display_mandatory')->nullable();
            $table->text('display_optional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_policies', function (Blueprint $table) {
            //
            $table->dropColumn('display_mandatory');
            $table->dropColumn('display_optional');
        });
    }
};
