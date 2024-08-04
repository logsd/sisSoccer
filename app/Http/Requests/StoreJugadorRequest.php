<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJugadorRequest extends FormRequest
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
        $jugadoreId = $this->route('jugadore') ? $this->route('jugadore')->id : null;

        return [
            'dni' => 'required|max:10|min:10|unique:players,dni,' .  $jugadoreId,
            'name' => 'required',
            'last_name' => 'required',
            'sexo' => 'required',
            'birthday' => 'required|date',
            'position' => 'required',
            'direction' => 'required',
            'img_url' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'own' => 'nullable|integer',
            'booster' => 'nullable|integer',
            'youth' => 'nullable|integer',
            'certified' => 'nullable|integer',
            'observation' => 'nullable',
            'f_from' => 'required|date',
            'f_until' => 'nullable|date',
            'province_id' => 'required|integer|exists:provinces,id',
            'team_id' => 'required|integer|exists:teams,id',
            'league_id' => 'required|integer|exists:leagues,id',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

    public function attributes()
    {
        return [
            'dni' => 'cedula',
            'name' => 'nombre',
            'last_name' => 'apellido',
            'birthday' => 'fecha de nacimiento',
            'position' => 'posición',
            'direction' => 'dirección',
            'img_url' => 'imagen',
            'own' => 'propio',
            'booster' => 'refuerzo',
            'youth' => 'juvenil',
            'certified' => 'certificado',
            'observation' => 'observación',
            'f_from' => 'fecha ingreso',
            'f_until' => 'fecha hasta',
            'province_id' => 'provincia',
            'team_id' => 'equipo',
            'league_id' => 'liga',
            'category_id' => 'categoria',
        ];
    }

    public function messages()
    {
        return [
            'province_id.required' => 'Se necesita seleccionar una provincia',
            'team_id.required' => 'Se necesita seleccionar un equipo',
            'league_id.required' => 'Se necesita seleccionar una liga',
            'category_id.required' => 'Se necesita seleccionar una categoria'
        ];
    }
}
