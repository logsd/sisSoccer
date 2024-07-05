<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampeonatoRequest extends FormRequest
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
        $campeonatoId = $this->route('campeonato') ? $this->route('campeonato')->id : null;

        return [
            'name' => 'required|max:60|unique:championships,name,' .  $campeonatoId,
            'year' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'from' => 'required|date',
            'until' => 'required|date',
            'description' => 'required|max:255',
            'observation' => 'required|max:255',
            'category_id' => 'required|integer|exists:categories,id'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'year' => 'año',
            'start_date' => 'fecha inicio',
            'end_date' => 'fecha fin',
            'from' => 'fecha desde',
            'until' => 'fecha hasta',
            'description' => 'descripción',
            'observation' => 'observación',
            'category_id' => 'categoria'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Se necesita seleccionar una categoria'
        ];
    }
}
