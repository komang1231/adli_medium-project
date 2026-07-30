<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
			'kode_menu' => 'required|string',
			'nama_menu' => 'required|string',
			'harga' => 'required',
			'stok' => 'required',
			'foto_menu' => 'required|string',
			'category_id' => 'required',
        ];
    }
}
