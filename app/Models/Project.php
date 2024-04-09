<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_type', 'title', 'owner','created_at', 'updated_at', 'slug','price','total_cpu','total_memory','total_server','total_server_on','total_storage','company_id','price_actual'

    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];
    public function server()
    {
        return $this->hasMany(ProjectServer::class,'project_id','id')->where('is_delete','=','0');
    }

    public function journey()
    {
        return $this->hasMany(ProjectJourney::class,'project_id','id');
    }

    public function ownername()
    {
        return $this->hasone(User::class,'id','owner');
    }

    public function firewall()
    {
        return $this->hasMany(ProjectFirewall::class,'project_id','id');
    }


    public function service_application()
    {
        return $user = DB::table('service_applications')->whereIn('id', $this->optional_sa_field)->first();

    }

    public function sg()
    {
        return $this->hasone(ProjectSecurityGroup::class,'project_id','id');
    }
    public function link($params = [])
    {
        return route('project.show', array_merge([$this->id,$this->slug], $params));
    }

    public function assetlink($params = [])
    {
        return route('project.asset.show', array_merge([$this->id,$this->slug], $params));
    }
    public function getProjectStatusAttribute()
    {
        if($this->status==1){
            return 'Draft';
        }
        if($this->status==2){
            return 'Review-lv1';
        }
        if($this->status==3){
            return 'Review-lv2';
        }
        if($this->status==4){
            return 'Review-lv3';
        }
        if($this->status==5){
            return 'Complete';
        }

    }

    public function total_cost()
    {
       $value=  $this->server->sum('price');
        return number_format((float)$value, 2, '.', '');
    }


    public function scopeWithStatus($query, $status)
    {

        //dd($status);
        switch ($status) {
            case 'draft':
                $query->ProjectDraft();
                break;
            case 'review':
                $query->ProjectReview();
                break;
            case 'approve':
                $query->ProjectApprove();
                break;
            case 'in-provision':
                $query->ProjectInProvision();
                break;
            case 'complete':
                $query->ProjectComplete();
                break;

            default:
                $query->ProjectAll();
                break;
        }
    }
    public function scopeProjectDraft($query)
    {
        return $query->where('status', '1');
    }

    public function scopeProjectReview($query)
    {
        return $query->where('status', '2')->orwhere('status', '3')->orwhere('status', '4');
    }

    public function scopeProjectApprove($query)
    {
        return $query->where('status', '3');
    }

    public function scopeProjectInProvision($query)
    {
        return $query->where('status', '4');
    }

    public function scopeProjectComplete($query)
    {
        return $query->where('status', '5');
    }

    public function scopeProjectAll($query)
    {
        return $query;
    }




}


