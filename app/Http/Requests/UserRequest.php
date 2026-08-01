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
        $id = $this->route('user')?->id;

        $rules = [
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'nama_user' => 'required|string|max:150',

            'email' => 'required|email|unique:users,email,' . $id,

            'no_tlp' => 'required|string|max:13|unique:users,no_tlp,' . $id,

        ];

        if ($this->isMethod('post')) {

            $rules['role'] = 'required|in:Manager,Admin,Staff';

            $rules['password'] = 'required|min:8|confirmed';
        }

        return $rules;
    }
}
