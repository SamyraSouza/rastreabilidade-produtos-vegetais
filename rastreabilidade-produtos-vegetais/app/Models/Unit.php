<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

      public function product(){
        return $this->belongsTo('App\Models\Product');
    }

}
