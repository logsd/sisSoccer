<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeriodoRequest extends FormRequest
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

        $periodoId = $this->route('periodo') ? $this->route('periodo')->id : null;
        return [
            'name' => 'required|max:60|unique:periods,name,' .  $periodoId,
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'team_id' => 'required|integer|exists:teams,id'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'start' => 'Fecha Inicio',
            'end' => 'Fecha Fin',
            'description' => 'descripcion',
            'team_id' => 'equipo'
        ];
    }

    public function messages()
    {
        return [
            'team_id.required' => 'Se necesita seleccionar un equipo'
        ];
    }
}
