<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
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
        $empleadoId = $this->route('empleado') ? $this->route('empleado')->id : null;
        return ['ci' => 'required|max:10|min:10|unique:employees,ci,' . $empleadoId,
            'name' =>'required|max:60|unique:employees,name,' .  $empleadoId,
        'last_name' =>'required|max:60|unique:employees,last_name,' . $empleadoId,
        'email'=> 'nullable|unique:employees,email,' . $empleadoId,
        'sex' => 'nullable|boolean',
        'birth_date'=> 'nullable|date',
        'direction'=> 'nullable',
        'f_income'=> 'required|date',
        'f_exit'=> 'nullable|date',
        'province_id' => 'nullable|integer|exists:provinces,id', 
        'department_id' => 'nullable|integer|exists:departments,id',
        'civil_status_id' => 'nullable|integer|exists:civil_statuses,id',
        'position_id' => 'nullable|integer|exists:positions,id'
         ];
    }
    public function attributes(){
        return [
            'ci' =>'ci',
            'name'=>'nombre',
            'last_name' => 'apellido',
            'email'=>'email',
            'sex'=>'sexo',
            'birth_date'=>'fecha de Nacimiento',
            'direction'=>'direccion',
            'f_income'=>'fecha de ingreso',
            'f_exit'=> 'fecha de salida',
            'province_id' => 'provincias',
            'department_id' => 'departamento',             
            'civil_status_id'=>'estadoCivil',
            'position_id'=>'posiciones',
            
        ];
    }
    public function messages(){
        return [

            'province_id.required' => 'Se necesita seleccionar el estado civil',
            'department_id.required' => 'Se necesita seleccionar un departamento',
            'civil_status_id.required' => 'Se necesita seleccionar el estado civil',
            'position_id.required' => 'Se necesita seleccionar una posicion',
        ];
    }
}