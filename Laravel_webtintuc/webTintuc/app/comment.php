<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    protected $table = "comment";
     public function tintuc()
    {
    	return $this->belongsto('App\tintuc','idtintuc','id');
    }

     public function User()
    {
    	return $this->belongsto('App\User','idUser','id');
    }
}
