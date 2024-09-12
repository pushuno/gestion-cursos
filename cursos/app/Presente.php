<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presente extends Model
{
    public function fecha(){
        return $this->belongsTo(Fecha::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
