<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VmTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'dc_name','dc_id',
        'vm_id',
        'vm_name',
        'vm_cpu',
        'vm_men',
        'vm_os',
        'vc_name',
        'vc_id',
        'host_name',
        'host_id',
        'cluster_name',
        'cluster_id',
        'power_status',
        'boottime',
        'is_template',
        'vmfolder',
        'storage_usage',
        'committed',
        'uncommitted',
        'unshared','sync_status',
        'h_vcpu','h_vmen',
        'f_vm_cost','h_vcpu_price','h_vmen_price','h_vstorage','h_vstorage_unit','h_vstorage_price',
        'f_vcpu_price','f_vmen_price','f_vstorage_price'
    ];
}
