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
        $categories = [
            [
                'name'        => 'Facilities',
                'description' => 'Facilities',
            ],
            [
                'name'        => 'Labor',
                'description' => 'Labor',
            ],
            [
                'name'        => 'Maintenance',
                'description' => 'Maintenance',
            ],
            [
                'name'        => 'Network',
                'description' => 'Network',
            ],
            [
                'name'        => 'OS License',
                'description' => 'OS License',
            ],
            [
                'name'        => 'Server Hardware',
                'description' => 'Server Hardware',
            ],
            [
                'name'        => 'Storage',
                'description' => 'Storage',
            ],
        ];

        DB::table('cost_categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('cost_categories')->truncate();
    }
};
