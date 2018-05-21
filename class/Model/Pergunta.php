<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    public $timestamps = false;

    public function opcoes()
    {
        return $this->hasMany(Opcao::class);
    }

    public function questionario()
    {
        return $this->belongsTo(Questionario::class);
    }
}