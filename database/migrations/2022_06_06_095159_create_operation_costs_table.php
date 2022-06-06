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
        Schema::create('operation_costs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('profile')->comment("Opex or Capex");
            $table->integer('profile_type')->comment("6 type");
            $table->integer("create_by")->comment("HOD");
            $table->integer("department_id")->comment("department");
            $table->decimal('cost', 10, 2);
            $table->string("cost_method")->comment("if one time, select month;if monthl, use start & end date");
            $table->timestamp('start_from')->nullable();
            $table->timestamp('end_from')->nullable();
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
        Schema::dropIfExists('operation_costs');
    }
};
