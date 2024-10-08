<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{

    public function batches(){
        return $this->hasOne('App\Models\Batch');
    }

    public function people(){
        return $this->hasOne('App\Models\Person');
    }
    
    protected $guarded = [];
    
}
