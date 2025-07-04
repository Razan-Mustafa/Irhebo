<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
            'user_id'=>'sometimes',
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cover' => 'required',
            'media' => 'required',
            'array',
            'media.*' => 'required',
            'service_ids' => 'nullable|array',
            'service_ids.*' => 'nullable',
        ];
    }
}
