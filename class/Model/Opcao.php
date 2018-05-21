<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Opcao extends Model
{
    public $timestamps = false;
    protected $table = "opcoes";

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }
}