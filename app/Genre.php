<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function groups(){
        return $this->belongsToMany(\App\Group::class);
    }
}
