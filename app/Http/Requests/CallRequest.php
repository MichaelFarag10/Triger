<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallRequest extends FormRequest
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
            'customer_name' => 'required|string',
            'phone' => 'required|numeric|unique:inquiries,phone',
            'phone2' => 'nullable|numeric|unique:inquiries,phone2',
            'national_id' => 'required|unique:inquiries,national_id,',
            'date_in' => 'required',
            'address' => 'required|string',
            'address2' => 'nullable|string',
            'inquiry_type' => 'required',
            'city' => 'required',
            'status' => 'required',
            'reason' => 'nullable|string',
            'date_pending' => 'nullable',
            'code' => 'nullable',
            'code2' => 'nullable',
            'job' => 'required|string',
            'journey' => 'nullable|integer',
            'journey2' => 'nullable|integer',
            'product' => 'nullable|string',

        ];
    }
}
