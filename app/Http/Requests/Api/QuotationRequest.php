<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to true to allow all users to make requests
    }

    public function rules()
    {
        return [
            'category_id'=>'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'delivery_day' => 'required|integer',
            'revisions' => 'required|integer',
            'source_file' => 'required|boolean',
        ];
    }
}