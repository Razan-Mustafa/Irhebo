<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'prefix' => 'required|string|max:10',
            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    $exists = \App\Models\User::where('phone', $value)
                        ->where('prefix', $this->prefix)
                        ->exists();

                    if ($exists) {
                        $fail(__('unique_with_prefix'));
                    }
                }
            ],
            'gender' => 'required|string|in:male,female,other',
            'profession_id' => 'required|exists:professions,id',
            'country_id' => 'required|exists:countries,id',
            'password' => 'required|string|min:8',
            'avatar' => 'nullable',
            'player_id' => 'nullable',
            'platform' => 'nullable',
            'google_id' => 'nullable',
            'languages' => 'nullable|array',
            'languages.*' => 'integer|exists:languages,id',
        ];
    }
}
