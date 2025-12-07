<?php

namespace App\Http\Requests\Monitoramentos;

use Illuminate\Foundation\Http\FormRequest;

class MonitoramentoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "paciente_id"        => "required|integer|exists:users,id",
            "profissional_id"    => "nullable|integer|exists:users,id",
            "dt_monitoramento"   => "required|date",
            "hora_monitoramento" => "required|date_format:H:i:s",
            "tipo"               => "required|in:Diabetes,Hipertensao,Outra",
            "observacoes"        => "nullable|string"
        ];
    }

    public function messages()
    {
        return [
            'paciente_id.required' => 'O ID do paciente é obrigatório para criar um monitoramento.',
            'paciente_id.integer'  => 'O ID do paciente deve ser um número inteiro.',
            'paciente_id.exists'   => 'O paciente informado não foi encontrado no sistema.',
            
            'profissional_id.integer'  => 'O ID do profissional deve ser um número inteiro.',
            'profissional_id.exists'   => 'O profissional informado não foi encontrado no sistema.',

            'dt_monitoramento.required' => 'A data do monitoramento é obrigatória.',
            'dt_monitoramento.date'     => 'A data do monitoramento deve ser válida.',

            'hora_monitoramento.required'     => 'A hora do monitoramento é obrigatória.',
            'hora_monitoramento.date_format'  => 'A hora deve estar no formato HH:MM:SS.',

            'tipo.required' => 'O tipo do monitoramento é obrigatório.',
            'tipo.in'       => 'O tipo informado é inválido. Use: Diabetes, Hipertensao ou Outra.',

            'observacoes.string' => 'As observações devem ser um texto.'
        ];
    }
}
