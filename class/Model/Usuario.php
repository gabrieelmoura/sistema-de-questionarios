<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $timestamps = false;
    protected $fillable = ['email'];

    public function preenchimentos()
    {
        return $this->hasMany(Preenchimento::class);
    }
}