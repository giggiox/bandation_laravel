<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class G_photo extends Model
{
    public function group(){
        return $this->belongsTo(\App\Group::class);
    }
}
