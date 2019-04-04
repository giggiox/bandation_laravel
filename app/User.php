<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function groups(){
        return $this->belongsToMany(\App\Group::class)->withPivot('privilege');
    }
    public function groups_accepted(){//i gruppi di cui un utente fa parte
        return $this->groups()
            ->wherePivotIn("privilege",[1,2,3]);
    }
    public function groups_request(){ //i gruppi a cui un utente ha fatto una richiesta che ancora non è stata accettata
        return $this->groups()
            ->wherePivot("privilege","=",4);
    }
    public function groups_refused(){ //per vedere da quale gruppi un utente è stato rifiutato
        return $this->groups()
            ->wherePivot("privilege","=",5);
    }


    public function groups_admin(){
        return $this->groups()
            ->wherePivotIn("privilege",[1,2]);
    }


    public function group_user_per_group($group_id){
        return $this->hasMany(\App\GroupUser::class)->where("group_id",$group_id)->first();
        //first() perche voglio solo il primo risultato che è un obj di tipo GroupUser senno ritorna un array 

    }


    public function events(){
        return $this->hasManyThrough(\App\Event::class,\App\GroupUser::class);
    }


    public function instruments(){
        return $this->belongsToMany(\App\Instrument::class);
    }
    public function instrument_users(){
        return $this->hasMany(\App\Instrument_User::class);
    }


    public function u_photos(){
        return $this->hasMany(\App\U_photo::class)->orderByDesc('created_at');
    }

    protected $fillable = [
        'name', 'email', 'password','surname','place','lat','lng','born_date','verify_token','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
}
