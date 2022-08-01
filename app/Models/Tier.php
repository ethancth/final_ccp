<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    use HasFactory;

    protected $fillable=['name','display_name','display_description','company_id','status','display_icon','display_icon_colour'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'id','company_id');
    }
}
