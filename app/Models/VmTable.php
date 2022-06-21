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

    public function cluster()
    {
        return $this->hasOne('App\Models\Cluster','domain_id','cluster_id');
    }
    public function vmdatastore()
    {
        return $this->hasMany('App\Models\VmDatastore','vm_id','vm_id')->where('sync_status',1);
    }

    public function owner()
    {
        return $this->belongsToMany(Vmtable::Class, 'user_vms', 'vm_uuid', 'user_id');
    }




    public function getvmpowerstatus(){
        $data=[];
        $data['total_vm'] = 0;
        $data['total_vm_power_on'] = 0;
        $data['total_vm_power_off'] = 0;

        $count_vm = $this->where('vm_cpu','<>','')->where('is_template','false')->where('sync_status',1)->count();
        $count_vm_on = $this->where('vm_cpu','<>','')->where('is_template','false')->where('sync_status',1)->where('power_status','poweredOn')->count();
        $count_vm_off = $this->where('vm_cpu','<>','')->where('is_template','false')->where('sync_status',1)->where('power_status','poweredOff')->count();
        $data['total_vm']=$count_vm;
        $data['total_vm_power_on']=$count_vm_on;
        $data['total_vm_power_off']=$count_vm_off;
        if($count_vm!=0 ){


            $data['percentage_power_on']=($count_vm_on/$count_vm)*100;
        }else{
            $data['percentage_power_on']=0;
        }

        $data['percentage_power_on']=number_format($data['percentage_power_on'], 0, '.', ',');
        return $data;
    }
}
