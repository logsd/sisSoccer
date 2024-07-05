<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\GenCharge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCargoOficina;

class StoreCargoOficina extends FormRequest
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
        $cargooficinaId = $this->route('cargooficina') ? $this->route('cargooficina')->id : null;

        return [
            'name' => 'required|unique:gen_charges,name,' . $cargooficinaId,
            'short_name' =>'required|nullable|max:10' ,
            'description' =>'nullable',
        ];
    }
}
