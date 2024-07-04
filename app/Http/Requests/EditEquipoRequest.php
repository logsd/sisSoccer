<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEquipoRequest extends FormRequest
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
        $equipoId = $this->route('equipo') ? $this->route('equipo')->id : null;

        return [
            'name' => 'required|max:60|unique:teams,name,' .  $equipoId,
            'gender' => 'required',
            'cluster' => 'required',
            'points' => 'nullable',
            'gol_afa' => 'nullable',
            'gol_enc' => 'nullable',
            'description' => 'nullable',
            'championship_id' => 'required|integer|exists:championships,id',
            'category_id' => 'required|integer|exists:categories,id',
            'club_id' => 'required|integer|exists:clubs,id'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'gender' => 'genero',
            'cluster' => 'grupo',
            'description' => 'descripcion',
            'championship_id' => 'campeonato',
            'category_id' => 'categoria',
            'club_id' => 'club',
           
        ];
    }

    public function messages()
    {
        return [
            'championship_id.required' => 'Se necesita seleccionar un campeonato',
            'category_id.required' => 'Se necesita seleccionar una categoria',
            'club_id.required' => 'Se necesita seleccionar un club',
        ];
    }
}
