<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create();

        $user = User::find(1);
        $user->name = 'Super Admin';
        $user->email = 'admin@local.com';
        $user->password = hash::make('admin@local.com');
        $user->save();
    }
}
