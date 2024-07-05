<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaseRequest extends FormRequest
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
        $faseId = $this->route('fase') ? $this->route('fase')->id : null;
        $grupoId = $this->route('fase') ? $this->route('fase')->leagueGroups->first()->id : null;

        return ['name' =>'required|max:30|unique:league_phases,name,' .  $faseId,
        'description' => 'nullable|max:255',
        'championship_id' => 'required|integer|exists:championships,id',
        'nameGrupo' => 'required|max:30|unique:league_groups,name,' . $grupoId,
        'descriptionGrupo' => 'required|max:255',
         ];
    }
    public function attributes(){
        return [
            'name' => 'nombre',
            'description' => 'descripción',
            'nameGrupo' => 'Nombre Grupo',
            'descriptionGrupo' => 'Descripción Grupo',
            'championship_id' => 'campeonato',
        ];
    }

    public function messages(){
        return [
            'championship_id.required' => 'Se necesita seleccionar un campeonato',
            'nameGrupo.required' => 'Se necesita asignar un nombre de grupo a la fase',
            'descriptionGrupo.required' => 'Se necesita asignar una descripcion de grupo a la fase',
        ];
    }
}
