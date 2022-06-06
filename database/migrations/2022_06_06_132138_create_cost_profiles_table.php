<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('cost_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('vcpu');
            $table->decimal('vcpu_price', 10, 2);
            $table->integer('vmen');
            $table->decimal('vmen_price', 10, 2);
            $table->integer('vstorage');
            $table->string('vstorage_unit')->comment("GB/TB");
            $table->decimal('vstorage_price', 10, 2);
            $table->decimal('h_vcpu_price',10,2)->nullable();
            $table->decimal('h_vmen_price',10,2)->nullable();
            $table->decimal('h_vstorage_price',10,2)->nullable();
            $table->integer('created_by')->comment("create by");
            $table->timestamps();
        });
        DB::table('cost_profiles')->insert([
            'name' => 'Default Cost Profile',
            'description'=>'Default Cost Profile',
            'vcpu'=>'1',
            'vcpu_price'=>'5',
            'vmen'=>'2',
            'vmen_price'=>'8',
            'vstorage'=>'100',
            'vstorage_unit'=>'GB',
            'vstorage_price'=>'10',
            'created_by'=>'1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_profiles');
    }
};
