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
            // 'kode_menu' => 'required|string',
            'nama_menu' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|in:pcs,gelas,cup,botol,porsi',
            'category_id' => 'required|exists:categories,id',
            'foto_menu' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
