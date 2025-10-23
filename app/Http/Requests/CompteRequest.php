<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompteRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust authorization logic as needed
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'numero' => ['nullable', 'string', 'max:255', 'unique:comptes,numero'],
            'solde' => ['nullable', 'numeric', 'min:0'],
            'type' => ['required', 'in:courant,epargne'],
            'status' => ['nullable', 'in:active,blocked'],
        ];
    }
}
