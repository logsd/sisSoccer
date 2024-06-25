<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClubRequest extends FormRequest
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
        $clubId = $this->route('club') ? $this->route('club')->id : null;

        return [
            'name' =>'required|max:60|unique:clubs,name,' .  $clubId,
            'trade_name'=> 'nullable',
            'reason_social'=> 'nullable',
            'ruc'=> 'required|max:13',
            'direction'=> 'nullable',
            'email'=> 'nullable|unique:clubs,email,' . $clubId,
            'date_constion'=> 'nullable',
            'direction_web'=> 'nullable',
            'slogan'=> 'nullable',
            'logo'=> 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'description'=> 'nullable|max:255',
            'parish'=> 'nullable',
            'current'=> 'nullable|boolean'];
    }
}
