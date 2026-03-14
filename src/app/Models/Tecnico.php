<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $fillable = ['nome', 'email', 'especialidade'];

    public function chamados()
    {
        return $this->hasMany(Chamado::class);
    }
}
