<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLenderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'purpose' => 'required|string|in:Puschase,Rate/Term,Cashout,HELOC,Second',
            'product' => 'required|string|in:Conventional,FHA,VA,HELOC,Second,Non-QM',
            'rates' => 'required|array',
        ];
    }
}
