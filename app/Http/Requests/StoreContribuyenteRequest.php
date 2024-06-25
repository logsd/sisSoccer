<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContribuyenteRequest extends FormRequest
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
        $contribuyenteId = $this->route('contribuyente') ? $this->route('contribuyente')->id : null;

        return [
            'name'=>'required|max:60|unique:taxpayer_types,name,' .  $contribuyenteId,
            'description'=>'nullable|max:255',
            'a_cont'=> 'nullable|boolean',
            'vg'=> 'nullable|boolean',
        ];
    }
}
