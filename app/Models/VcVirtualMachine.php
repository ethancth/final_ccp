<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VcVirtualMachine extends Model
{
    use HasFactory;

    protected $fillable=[

        'vm_object_id',
        'vm_hostname',
        'vcpu',
        'vmem',
        'vstorage',
        'power_status',
        'project_id',
        'vm_owner',
        'assign_status',
    ];
}
