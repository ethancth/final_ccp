<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{

    protected $fillable = [
        'host_id','host_name','cpuMhz','numCpuPkgs','numCpuCores','numCpuThreads','memorySize','numNics','cpuModel','sync_status'
    ];
}
