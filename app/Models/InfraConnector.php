<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfraConnector extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'display_name',
        'server_address',
        'credential',
        'connection_status',
    ];

    protected $hidden =[
        'credential'];



    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }


}
