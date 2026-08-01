<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
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
			// 'kode_transaksi' => 'required|string',
			// 'status_pesanan' => 'required',
			// 'tipe_pelanggan' => 'required',
			'nama_pelanggan' => 'required|string',
			'no_tlp' => 'required|string',
			// 'payment_method_id' => 'required',
			'payment_provider_id' => 'required',
			// 'ppn' => 'required',
			// 'harga_ppn' => 'required',
			// 'service_charge' => 'required',
			// 'harga_service_charge' => 'required',
			// 'grand_total' => 'required',
			// 'user_id' => 'required',
        ];
    }
}
