<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ReservRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();

        return Auth::check() &&
            ($user->isA('user') || $user->can('reserv-index'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'numero' => 'required|integer',
            'date_reservation' => 'required|date',
            'heure_reservation' => 'required|date_format:H:i',
            'prix' => 'required|numeric|between:0,999.99',
            'nombre_place' => 'required|integer',
            'salle_id' => 'required|exists:salles,id',
            'client_id' => 'required|exists:clients,id',
        ];
    }
}
