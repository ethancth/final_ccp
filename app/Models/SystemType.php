<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemType extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    protected $fillable=['name','display_name','company_id','display_description','status','display_icon','display_icon_colour','is_default'];

    public function company()
    {
        return $this->belongsTo(Company::class,'id','company_id');
    }

    public function getSystemTypeDisplayNameAttribute()
    {
        return $this->display_name;
    }
}
