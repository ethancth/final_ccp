<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatastoreCostProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'vstorage_price','vstorage','vstorage_unit','h_vstorage_price',
    ];

    public function datastore(){
        return $this->belongsTo('Datastore','cost_profile_id','id');
    }
}
