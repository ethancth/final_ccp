<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;


    public function update(User $currentUser, Company $company)
    {
        return $currentUser->id === $company->master_id;
    }
}
