<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReporteRequest extends FormRequest
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

        $reporteId = $this->route('reporte') ? $this->route('reporte')->id : null;

        return ['name' =>'required|max:60|unique:gen_reports,name,' .  $reporteId,
        'role' => 'nullable',
        'description' => 'nullable'
         ];
    }
}
