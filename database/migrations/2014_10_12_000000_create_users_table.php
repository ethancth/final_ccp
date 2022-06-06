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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('avatar')->nullable();
            $table->string('introduction')->nullable();
            $table->string('contact')->nullable();
            $table->timestamps();
        });
        //
        $default_user = [
            [
                'name'        => 'Super Admin',
                'email' => 'admin@local.com',
                'password' => '$2y$10$u3qvP/LpDOMspS0CgwTRe.nP/6/XBt5loHARzOUwpd4aFI1gdQ4tO',
                'created_at' => '2022-06-06 09:46:28',
                'updated_at' => '2022-06-06 09:46:28'
            ]
            ];
        DB::table('users')->insert($default_user);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
