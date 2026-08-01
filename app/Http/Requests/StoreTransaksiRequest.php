<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'customer_id' => ['nullable', 'exists:members,id'],

            'is_member' => ['required', 'boolean'],

            'payment_provider_id' => [
                'required',
                'exists:payment_providers,id'
            ],

            'items' => ['required']

        ];
    }
}
