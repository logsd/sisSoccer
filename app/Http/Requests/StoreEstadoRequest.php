<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstadoRequest extends FormRequest
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
        $estadoId = $this->route('estado') ? $this->route('estado')->id : null;

        return ['name' =>'required|max:60|unique:state_parameters,name,' .  $estadoId,
        'process' => 'nullable',
        'description' => 'nullable|max:255'
         ];
    }
}
