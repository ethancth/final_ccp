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
        Schema::table('project_security_group_envs', function (Blueprint $table) {
            //
            $table->string('scope')->nullable()->comment('is project scope for env or tier');
            $table->string('can_delete')->default('1')->comment('0 is pre-create, cannot delete, 1 is can delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_security_groups', function (Blueprint $table) {
            //
            $table->dropColumn('scope');
            $table->dropColumn('can_delete');
        });
    }
};
