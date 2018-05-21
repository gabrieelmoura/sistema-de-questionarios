<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Preenchimento extends Model
{
    public $timestamps = false;
    protected $fillable = ['questionario_id', 'usuario_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function questionario()
    {
        return $this->belongsTo(Questionario::class);
    }

    public function respostas()
    {
        return $this->hasMany(Resposta::class);
    }
}