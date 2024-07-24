<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenEstadoRequest extends FormRequest
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
        $genEstadoId = $this->route('genEstado') ? $this->route('genEstado')->id : null;
        return [
            //
            'name' =>'required|max:60|unique:gen_states,name,' .  $genEstadoId,
            'description' => 'nullable',
            'league_executive_id' => 'nullable|integer|exists:league_executives,id', 
        ];
    }
    public function attributes(){
        return [
            
            'name'=>'nombre',
            'description' => 'descripcion',
            'league_executive_id' => 'ejecutivos',             
        ];
    }
    public function messages(){
        return [

            'league_executive_id.required' => 'Se necesita seleccionar un ejecutivo',
        ];
    }
}
