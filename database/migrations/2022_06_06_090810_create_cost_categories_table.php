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
        Schema::create('cost_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index()->comment('Name');
            $table->text('description')->nullable()->comment('desc');
            $table->integer('post_count')->default(0)->comment('count');
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
        Schema::dropIfExists('cost_categories');
    }
};
