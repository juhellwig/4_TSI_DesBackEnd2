<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoramento extends Model
{
    /** @use HasFactory<\Database\Factories\MonitoramentosFactory> */
    use HasFactory;

    /**
     * Nome da tabela associada ao model.
     *
     * @var string
     */
    protected $table = 'monitoramentos';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'dt_monitoramento',
        'hora_monitoramento',
        'tipo',
        'observacoes',
    ];

    /**
     * Atributos que devem ser convertidos para tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'dt_monitoramento' => 'date',
            'hora_monitoramento' => 'string',
        ];
    }

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function profissional()
    {
        return $this->belongsTo(User::class, 'profissional_id');
    }
}
