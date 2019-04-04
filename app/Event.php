<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function group_user(){ //l'underscore perche groupuser senza è un typo
        return $this->belongsTo(\App\GroupUser::class);
    }

    protected $fillable=[
    	'title','description','start_hout','end_hour','place','lat','lng','event_date'
    ];
}
