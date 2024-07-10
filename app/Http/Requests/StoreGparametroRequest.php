<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGparametroRequest extends FormRequest
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
        $gparametroId = $this->route('gparametro') ? $this->route('gparametro')->id : null;
        return [
            'state_parameters_id' => 'nullable|integer|exists:state_parameters,id',
            'civil_status_id' => 'nullable|integer|exists:civil_status,id',    
            'phone_operator_id' => 'nullable|integer|exists:phone_operator,id',    
            'taxpayer_types_id' => 'nullable|integer|exists:taxpayer_types,id',    
            'type_parameters_id' => 'nullable|integer|exists:type_parameters,id',    
            'type_sanctions_id' => 'nullable|integer|exists:type_sanctions,id', 
        ];
    }
    public function attributes(){
        return [
            'state_parameters_id' =>'estado',
            'civil_status_id'=>'estadosCiviles',
            'phone_operator_id' =>'telefono',
            'taxpayer_types_id' =>'contribuyente',
            'type_parameters_id' =>'parametro',
            'type_sanctions_id' => 'sancion',             
        ];
    }
    public function messages(){
        return [

            'state_parameters_id.required' =>'Se necesita seleccionar un estado',
            'civil_status_id.required'=>'Se necesita seleccionar un estado civil',
            'phone_operator_id.required' =>'Se necesita seleccionar una operadora telefonica',
            'taxpayer_types_id.required' =>'Se necesita seleccionar un contribuyente',
            'type_parameters_id.required' =>'Se necesita seleccionar un tipo de parametro',
            'type_sanctions_id.required' =>'Se necesita seleccionar un tipo de sancion',  

        ];
    }
}
