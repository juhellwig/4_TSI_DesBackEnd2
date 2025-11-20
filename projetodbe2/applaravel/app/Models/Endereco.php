<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    /** @use HasFactory<\Database\Factories\EnderecosFactory> */
    use HasFactory;

    /**
     * Nome da tabela associada ao model.
     *
     * @var string
     */
    protected $table = 'enderecos';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'pais',
    ];

    /**
     * Indica se o modelo deve gerenciar automaticamente os timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Atributos que devem ser convertidos para tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'numero' => 'integer',
            'cep' => 'string',
            'logradouro' => 'string',
            'complemento' => 'string',
            'bairro' => 'string',
            'cidade' => 'string',
            'estado' => 'string',
            'pais' => 'string',
        ];
    }
}