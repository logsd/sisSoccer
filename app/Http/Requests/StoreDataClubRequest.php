<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataClubRequest extends FormRequest
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
        $dataClubId = $this->route('dataClub') ? $this->route('dataClub')->id : null;

        return [
            'phone'=>'required|max:10|min:10|unique:date_clubs,phone,' .  $dataClubId,
            'operator'=> 'nullable|max:20',
            'description'=> 'nullable|max:255',
            'club_id'=> 'required|integer|exists:clubs,id'
        ];
    }
}
