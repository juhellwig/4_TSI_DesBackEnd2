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
            'dt_monitoramento' => 'sometimes|date',
            'hora_monitoramento' => 'sometimes|date_format:H:i',
            'tipo' => 'sometimes|in:Diabetes,Hipertensao,Outra',
            'observacoes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'dt_monitoramento.date' => 'A data deve ser válida.',
            'hora_monitoramento.date_format' => 'A hora deve estar no formato HH:MM.',
            'tipo.in' => 'O tipo deve ser Diabetes, Hipertensao ou Outra.',
            'observacoes.string' => 'As observações devem ser texto.',
        ];
    }
}
