<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarnetRequest extends FormRequest
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
        $carnetId = $this->route('carnet') ? $this->route('carnet')->id : null;
        return [
            //
            'cod' => 'nullable|string',
            'player_id' => 'nullable|integer|exists:player,id',    
            'championship_id' => 'nullable|integer|exists:championship,id', 
        ];
    }
    public function attributes(){
        return [
            
            'cod'=>'codigo',
            'player_id' => 'jugador',
            'championship_id' => 'campeonato',             
        ];
    }
    public function messages(){
        return [

            'player_id.required' => 'Se necesita seleccionar un jugador',
            'championship_id.required' => 'Se necesita seleccionar un campeonato',
        ];
    }
}
