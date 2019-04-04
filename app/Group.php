<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function events(){
        return $this->hasManyThrough(\App\Event::Class,\App\GroupUser::class);
    }
    public function groupuser(){
        return $this->hasMany(\App\GroupUser::class);
    }

    public function users(){
        return $this->belongsToMany(\App\User::class)->withPivot('privilege')->withTimestamps();;
    }
    public function users_accepted(){
        return $this->users()
            ->wherePivotIn("privilege",[1,2,3]);
    }
    public function users_request(){
        return $this->users()
            ->wherePivot("privilege","=",4);
    }
    public function users_refused(){
        return $this->users()
            ->wherePivot("privilege","=",5);
    }



    public function genres(){
        return $this->belongsToMany(\App\Genre::class);
    }


    public function g_photos(){
        return $this->hasMany(\App\G_photo::class);
    }


    protected $fillable = [
        'name', 'lat', 'lng','place'
    ];
}
