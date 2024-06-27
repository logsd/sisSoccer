<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEjecutivoRequest extends FormRequest
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
        $ejecutivoId = $this->route('ejecutivo') ? $this->route('ejecutivo')->id : null;

        return [
            'dni' => 'required|max:10|min:10|unique:league_executives,dni,' . $ejecutivoId,
            'name' =>'required|max:60',
            'lastname'=> 'nullable',
            'address'=> 'nullable',
            'email'=> 'nullable|unique:league_executives,email,' . $ejecutivoId,
            'img_path'=> 'nullable|image|mimes:png,jpg,jpeg|max:2048'
            ];
    }
}
