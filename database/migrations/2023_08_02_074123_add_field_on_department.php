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
        Schema::table('departments', function (Blueprint $table) {
            //
            $table->string('company_id')->nullable()->after('department_name');
            $table->string('slug')->nullable()->after('company_id');
            $table->string('total_member')->nullable()->after('slug');
            $table->string('total_hod')->nullable()->after('total_member');
            $table->string('display_hod')->nullable()->after('total_hod');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            //
            $table->dropColumn('company_id');
            $table->dropColumn('slug');
            $table->dropColumn('total_member');
            $table->dropColumn('total_hod');
            $table->dropColumn('display_hod');
        });
    }
};
