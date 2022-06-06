<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'serverip', 'username', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
