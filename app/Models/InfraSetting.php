<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfraSetting extends Model
{
    use HasFactory;
    protected $hidden=['vra_credential'];

    protected $fillable=[
        'company_id',
        'vra_server',
        'vra_domain',
        'vra_user_id',
        'vra_credential',
        'expired_date',
        'refresh_token',
        'network_workflow',
        'token'
    ];

}
