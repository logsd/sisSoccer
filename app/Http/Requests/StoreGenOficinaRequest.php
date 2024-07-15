<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenOficinaRequest extends FormRequest
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
        $genOficinaId = $this->route('genOficina') ? $this->route('genOficina')->id : null;
        return [
            //
            'name' =>'required|max:60|unique:gen_offices,name,' .  $genOficinaId,
            'short_name' => 'nullable',
            'address' => 'nullable',
            'report_id' => 'nullable|integer|exists:gen_reports,id',    
            'commission_league_id' => 'nullable|integer|exists:commission_leagues,id', 
            'charge_id' => 'nullable|integer|exists:gen_charges,id',    
            'club_id' => 'nullable|integer|exists:clubs,id',    
        ];
    }
    public function attributes(){
        return [
            
            'name'=>'nombre',
            'short_name'=>'nombreCorto',
            'address'=>'direccion',
            'report_id' => 'reporte',    
            'commission_league_id' => 'comision', 
            'charge_id' => 'cargo',    
            'club_id' => 'club',              
        ];
    }
    public function messages(){
        return [

            'report_id' => 'Se necesita seleccionar un reporte',    
            'commission_league_id' => 'Se necesita seleccionar una comision', 
            'charge_id' => 'Se necesita seleccionar un cargo',    
            'club_id' => 'Se necesita seleccionar un club',  
        ];
    }
}
