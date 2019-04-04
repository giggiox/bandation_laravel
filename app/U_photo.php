<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class U_photo extends Model
{
    public function user(){
        return $this->belongsTo(\App\User::class);
    }

    protected $fillable=[
        'path',
        'description'
    ];
}
