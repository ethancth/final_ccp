<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name', 'hod','company_id','slug','total_member','total_hod','display_hod','all_uid','hod_id','is_default'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function member()
    {
        return $this->belongsToMany(User::class,'department_members','department_id','user_id'
        );
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'id','company_id');
    }
}
