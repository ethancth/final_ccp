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
        Schema::create('cost_type_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();

        });

        DB::table('cost_type_profiles')->insert([
            'name' => 'Opex',
        ]);
        DB::table('cost_type_profiles')->insert([
            'name' => 'Capex',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_type_profiles');
    }
};
