<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingSystem extends Model
{
    use HasFactory;

    protected $fillable=['name','display_name','display_description','company_id','cost','os_type','status','display_icon','display_icon_colour','is_default'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'id','company_id');
    }
}
