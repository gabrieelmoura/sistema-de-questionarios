<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Questionario extends Model
{
    public $timestamps = false;

    public function preenchimentos()
    {
        return $this->hasMany(Preenchimento::class);
    }

    public function perguntas()
    {
        return $this->hasMany(Pergunta::class);
    }
}