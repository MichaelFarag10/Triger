<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallUpdateRequest extends FormRequest
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
            'customer_name' => 'string',
            'phone' => 'numeric',
            'phone2' => 'nullable|numeric',
              'national_id' => 'numeric',
            'date_in' => 'date',
            "date_pending" => 'date|nullable',
            "date_out" => 'date|nullable',
           'address' => 'string',
           'address2' => 'nullable|string',
            'inquiry_type' => 'string',
            'city' => 'string',
            'reason' => 'string|nullable',
            'code' => 'nullable',
            'code2' => 'nullable',
            'job' => 'nullable|string',
            'journey' => 'nullable|integer',
            'journey2' => 'nullable|integer',
            'product' => 'nullable|string',
        ];
    }
}
