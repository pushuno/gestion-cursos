<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eje extends Model
{
    protected $fillable = ['nombre'];

    public function cursos(){
        return $this->hasMany(Curso::class);
    }
}
