<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenTelefonoRequest extends FormRequest
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
        
            $genTelefonoId = $this->route('genTelefono') ? $this->route('genTelefono')->id : null;
            return[
                'number' => 'required|max:10|min:10|unique:gen_telephones,number,' . $genTelefonoId,
                'description' => 'nullable',
                'league_executive_id' => 'nullable|integer|exists:league_executives,id',    
                'employee_id' => 'nullable|integer|exists:employees,id', 
            ];
    }
    public function attributes(){
        return [
            
            'number'=>'numero',
            'description'=>'descripcion',
            'league_executive_id' => 'ejecutivo',
            'employee_id' => 'empleado',             
        ];
    }
    public function messages(){
        return [

            'league_executive_id.required' => 'Se necesita seleccionar un ejecutivo',
            'employee_id.required' => 'Se necesita seleccionar un empleado',
        ];
    }
}
