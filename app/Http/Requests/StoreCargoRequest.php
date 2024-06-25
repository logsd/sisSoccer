<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCargoRequest extends FormRequest
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
        $cargoId = $this->route('cargo') ? $this->route('cargo')->id : null;

        return [
            'name'=>'required|max:60|unique:positions,name,' .  $cargoId,
            'f_start'=> 'nullable',
            'f_end'=> 'nullable',
            'observation'=>'nullable|max:255',
            'vg'=> 'nullable|boolean',
        ];
    }
}
