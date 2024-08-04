<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDirectClubRequest extends FormRequest
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
        $directClubId = $this->route('directClub') ? $this->route('directClub')->id : null;

        return [
            'name' => 'required|max:60',
            'email' => 'required|email|unique:direct_clubs,email,' . $directClubId,
            'phone' => 'nullable|max:10|min:10',
            'position' => 'nullable|unique:direct_clubs,position,' . $directClubId,
            'observation' => 'required',
            'club_id' => 'required|integer|exists:clubs,id',
            'championship_id' => 'required|integer|exists:championships,id'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'phone' => 'telefono',
            'position' => 'posición',
            'observation' => 'observación',
            'club_id' => 'club',
            'championship_id' => 'campeonato'
        ];
    }

    public function messages()
    {
        return [
            'club_id.required' => 'Se necesita seleccionar un club',
            'championship_id.required' => 'Se necesita seleccionar un campeonato',

        ];
    }
}
