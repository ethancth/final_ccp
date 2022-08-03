<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FormPolicy extends Model
{
    use HasFactory;
    protected $fillable=['env_field','tier_field','os_field','mandatory_field','optional_field','company_id'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'id','company_id');
    }

    public function envname()
    {
        return $this->hasOne(Environment::class,'id','env_field');
    }
    public function tiername()
    {
        return $this->hasOne(Tier::class,'id','tier_field');
    }
    public function osname()
    {
        return $this->hasOne(OperatingSystem::class,'id','os_field');
    }
    public function namemandatory()
    {
        return $user = DB::table('service_applications')->whereIn('id', $this->mandatory_field)->first();

    }
}
