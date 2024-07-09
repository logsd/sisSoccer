<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCalendarioRequest extends FormRequest
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
        return [
            'stadium' => 'required|max:30',
            'date' => 'required',
            'time' => 'required',
            'observation' => 'required|max:255',
            'status' => 'required|in:scheduled,in_progress,completed,canceled',
            'referee' => 'required',
            'vocal' => 'required',
            'team_home_id' => 'required|integer|exists:teams,id',
            'team_away_id' => 'required|integer|exists:teams,id',
            'league_phase_id' => 'nullable|integer|exists:league_phases,id',
            'championship_id' => 'nullable|integer|exists:championships,id',
        ];
    }

    public function attributes()
    {
        return [
            'stadium' => 'estadio',
            'date' => 'fecha',
            'time' => 'tiempo',
            'observation' => 'observación',
            'status' => 'Estado',
            'referee' => 'arbitro',
            'team_home_id' => 'Equipo Local',
            'team_away_id' => 'Equipo Visitante',
            'league_phase_id' => 'fase',
            'championship_id' => 'campeonato',
        ];
    }

    public function messages()
    {
        return [
            'team_home_id.required' => 'Se necesita seleccionar un equipo local',
            'team_away_id.required' => 'Se necesita seleccionar un equipo visitante',
            'stadium.required' => 'Se necesita asignar un estadio',
            'status.required' => 'Se necesita asignar un estado',
            'date.required' => 'Se necesita establecer una fecha',
            'time.required' => 'Se necesita establecer la hora',
        ];
    }
}
