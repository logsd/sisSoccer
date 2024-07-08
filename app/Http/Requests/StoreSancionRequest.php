<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\TypeSanction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreSancionRequest extends FormRequest
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
        $sancionId = $this->route('sancion') ? $this->route('sancion')->id : null;

        return [
            'name' => 'required|unique:type_sanctions,name,' . $sancionId,
        ];
    }
}