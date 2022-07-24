<?php

namespace App\Observers;
use App\Handlers\SlugHandler;
use App\Models\Company;
use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    //
    public function created(User $user)
    {

        if(!$user->company_id) {
            $company = Company::create([
                'name' => $user->name . " Company",
                'domain' => remove_spacing($user->name . "@local"),
                'slug' => app(SlugHandler::class)->translate($user->name . "@local"),
                'master_id'=>$user->id,
                'status' => 1
            ]);
            User::updateOrCreate(
                [
                    'id' => $user->id,
                ],
                [
                    'company_id' => $company->id,
                ]);
        }

//        $default_user = [
//            [
//                'name'        => 'Super Admin',
//                'email' => 'admin@local.com',
//                'password' => '$2y$10$u3qvP/LpDOMspS0CgwTRe.nP/6/XBt5loHARzOUwpd4aFI1gdQ4tO',
//                'created_at' => '2022-06-06 09:46:28',
//                'updated_at' => '2022-06-06 09:46:28'
//            ]
//        ];
//        DB::table('users')->insert($default_user);


    }
}
