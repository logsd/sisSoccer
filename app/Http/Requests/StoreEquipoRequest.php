<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoRequest extends FormRequest
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
            'name' => 'required|max:60|unique:teams,name',
            'gender' => 'required',
            'cluster' => 'required',
            'description' => 'nullable',
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
            'category_id' => 'categoria',
            'club_id' => 'club',
           
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Se necesita seleccionar una categoria',
            'club_id.required' => 'Se necesita seleccionar un club',
        ];
    }
}
