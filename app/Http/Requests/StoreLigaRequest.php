<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLigaRequest extends FormRequest
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
        $ligaId = $this->route('liga') ? $this->route('liga')->id : null;

        return [
            'name' => 'required|max:60|unique:leagues,name,' .  $ligaId,
            'trade_name' => 'required',
            'business_name' => 'required',
            'ruc' => 'required|max:13|min:13|unique:leagues,ruc,' . $ligaId,
            'direction' => 'required',
            'email' => 'required|email|unique:leagues,email,' . $ligaId,
            'constitution_date' => 'required',
            'direction_web' => 'required',
            'slogan' => 'required',
            'url_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'required',
            'url_sello' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'taxpayer_id' => 'required|integer|exists:taxpayer_types,id'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'trade_name' => 'nombre corto',
            'business_name' => 'nombre del negocio',
            'direction' => 'dirección',
            'constitution_date' => 'fecha de creación',
            'direction_web' => 'dirección web',
            'url_logo' => 'logo',
            'description' => 'descripción',
            'url_sello' => 'sello',
            'taxpayer_id' => 'contribuyente',

        ];
    }

    public function messages()
    {
        return [
            'taxpayer_id.required' => 'Se necesita seleccionar un contribuyente',
        ];
    }
}
