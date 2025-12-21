<?php

namespace App\Http\Requests\Monitoramentos;

use Illuminate\Foundation\Http\FormRequest;

class MonitoramentoUpdateRequest extends FormRequest
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
            'dt_monitoramento'  => 'required|date',
            'hora_monitoramento'=> 'required|date_format:H:i',
            'tipo'              => 'required|in:Diabetes,Hipertensao,Outra',
            'observacoes'       => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'dt_monitoramento.required' => 'A data do monitoramento é obrigatória.',
            'dt_monitoramento.date' => 'A data informada é inválida.',

            'hora_monitoramento.required' => 'A hora do monitoramento é obrigatória.',
            'hora_monitoramento.date_format' => 'O formato da hora deve ser HH:MM.',

            'tipo.required' => 'O tipo é obrigatório.',
            'tipo.in' => 'O tipo deve ser Diabetes, Hipertensao ou Outra.',

            'observacoes.string' => 'As observações devem ser um texto válido.',
        ];
    }
}
