<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    public $timestamps = false;

    public function opcao()
    {
        return $this->belongsTo(Opcao::class);
    }

    public function preenchimento()
    {
        return $this->belongsTo(Preenchimento::class);
    }
}