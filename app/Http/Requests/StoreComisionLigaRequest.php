<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\CommissionLeague;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class StoreComisionLigaRequest extends FormRequest
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
        $comisiondeligaId = $this->route('comisiondeliga') ? $this->route('comisiondeliga')->id : null;

        return [
            'name' => 'required|unique:commission_leagues,name,' . $comisiondeligaId,
            'short_name' =>'required|nullable|max:10' ,
            'role' =>'required|nullable' ,
            'description' =>'nullable',
        ];
    }
}
