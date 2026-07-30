<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'kode_payment_method' => 'PM-CSH',
                'nama_payment_method' => 'Cash',
            ],
            [
                'kode_payment_method' => 'PM-EWL',
                'nama_payment_method' => 'E-Wallet',
            ],
            [
                'kode_payment_method' => 'PM-TRF',
                'nama_payment_method' => 'Transfer Bank',
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
