<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
			// 'kode_user' => 'required|string',
			// 'foto_profile' => 'string',
			'nama_user' => 'required|string',
			'email' => 'required|string',
			'no_tlp' => 'required|string',
			// 'role' => 'required',
			// 'status' => 'required',
            'password' => 'required'
        ];
    }
}
