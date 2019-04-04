<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument_User extends Model
{
    protected $table="instrument_user";

    public function user(){
        return $this->belongsTo(\App\User::class);
    }

    public function instrument(){
        return $this->belongsTo(\App\Instrument::class);
    }

    public function genres(){
        return $this->belongsToMany(\App\Genre::class,'genre_instrument','instrument_user_id');
    }
}
