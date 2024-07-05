<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtapaRequest extends FormRequest
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
        $etapaId = $this->route('etapa') ? $this->route('etapa')->id : null;

        return ['name' =>'required|max:60|unique:gen_states,name,' .  $etapaId,
        'description' => 'nullable|max:255',
        'league_executive_id' => 'required|integer|exists:league_executives,id'
         ];
    }

    public function attributes(){
        return [
            'league_executive_id' => 'ejecutivo'
        ];
    }

    public function messages(){
        return [
            'league_executive_id.required' => 'Se necesita seleccionar una liga'
        ];
    }
}
