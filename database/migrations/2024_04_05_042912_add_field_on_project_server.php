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
            $table->text('display_optional_sa')->nullable()->after('optional_sa_field');
            $table->text('display_mandatory_sa')->nullable()->after('mandatory_sa_field');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_servers', function (Blueprint $table) {
            $table->dropColumn('display_optional_sa');
            $table->dropColumn('display_mandatory_sa');
            //
        });
    }
};
