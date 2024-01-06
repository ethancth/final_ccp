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
        Schema::table('cost_profiles', function (Blueprint $table) {

            $table->decimal('vcpu_price', 10, 5)->default('0.13464')->change();
            $table->decimal('vmen_price', 10, 5)->default('0.24708')->change();
            $table->decimal('vstorage_price', 10, 5)->default('0.00438')->change();
            $table->decimal('network_price', 10, 5)->default('0.13513');
            $table->decimal('history_vcpu_price',10,5)->nullable()->change();
            $table->decimal('history_vmen_price',10,5)->nullable()->change();
            $table->decimal('history_vstorage_price',10,5)->nullable()->change();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_profiles', function (Blueprint $table) {
            //
            $table->dropColumn('network_price');
        });
    }
};
