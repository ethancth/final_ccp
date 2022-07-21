<?php

namespace App\Observers;
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


    }
}
