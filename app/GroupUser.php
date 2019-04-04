<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table="group_user";
    public function group(){
        return $this->belongsTo(\App\Group::class);
    }
    public function user(){
        return $this->belongsTo(\App\User::class);
    }
    public function events(){
    	return $this->hasMany(\App\Event::class);
    }

}
