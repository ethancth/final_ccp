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
            $table->string ('name');
            $table->string ('description');
            $table->integer('vcpu')->default('1');
            $table->decimal('vcpu_price', 10, 2)->default('1');
            $table->integer('vmen')->default('1');
            $table->decimal('vmen_price', 10, 2)->default('1');
            $table->integer('vstorage')->default('1');
            $table->string ('vstorage_unit')->comment("GB/TB")->default('GB');
            $table->decimal('vstorage_price', 10, 2)->default('0.5');
            $table->decimal('history_vcpu_price',10,2)->nullable();
            $table->decimal('history_vmen_price',10,2)->nullable();
            $table->decimal('history_vstorage_price',10,2)->nullable();
            $table->integer('created_by')->comment("create by")->nullable();
            $table->integer('company_id')->comment("company id");
            $table->integer('status')->default('1');
            $table->integer('form_vcpu_min')->default('1');
            $table->integer('form_vcpu_max')->default('16');
            $table->integer('form_vmen_min')->default('1');
            $table->integer('form_vmen_max')->default('16');
            $table->integer('form_vstorage_min')->default('100')->comment('size by GB');
            $table->integer('form_vstorage_max')->default('1000');
            $table->string ('environment_profile')->nullable();
            $table->string ('tier_profile')->nullable();
            $table->string ('department_profile')->nullable();
            $table->integer('is_master')->default('0')->comment('master cost profile by company');
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
        Schema::dropIfExists('cost_profiles');
    }
};
