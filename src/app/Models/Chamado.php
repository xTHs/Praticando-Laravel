<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Chamado extends Model
{
    protected $fillable = [
        'titulo', 'descricao', 'prioridade', 'status',
        'data_abertura', 'tecnico_id', 'categoria_id',
    ];

    protected $casts = [
        'data_abertura' => 'datetime',
    ];

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function isSlaEstourado(): bool
    {
        if (!$this->categoria || in_array($this->status, ['resolvido', 'fechado'])) {
            return false;
        }

        $prazo = $this->data_abertura->addHours($this->categoria->sla_horas);
        return Carbon::now()->greaterThan($prazo);
    }
}
