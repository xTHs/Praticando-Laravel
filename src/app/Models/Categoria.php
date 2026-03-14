<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome', 'sla_horas'];

    public function chamados()
    {
        return $this->hasMany(Chamado::class);
    }
}
