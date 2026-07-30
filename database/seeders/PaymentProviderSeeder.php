<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\PaymentProvider;
use Illuminate\Database\Seeder;

class PaymentProviderSeeder extends Seeder
{
    public function run(): void
    {
        $cash = PaymentMethod::where('nama_payment_method', 'Cash')->first();
        $ewallet = PaymentMethod::where('nama_payment_method', 'E-Wallet')->first();
        $transfer = PaymentMethod::where('nama_payment_method', 'Transfer Bank')->first();

        $providers = [

            // Cash
            [
                'kode_payment_provider' => 'PP-CSH',
                'nama_payment_provider' => 'Cash',
                'payment_method_id' => $cash->id,
            ],

            // E-Wallet
            [
                'kode_payment_provider' => 'PP-DANA',
                'nama_payment_provider' => 'DANA',
                'payment_method_id' => $ewallet->id,
            ],
            [
                'kode_payment_provider' => 'PP-GOPAY',
                'nama_payment_provider' => 'GoPay',
                'payment_method_id' => $ewallet->id,
            ],
            [
                'kode_payment_provider' => 'PP-OVO',
                'nama_payment_provider' => 'OVO',
                'payment_method_id' => $ewallet->id,
            ],
            [
                'kode_payment_provider' => 'PP-SHOPEEPAY',
                'nama_payment_provider' => 'ShopeePay',
                'payment_method_id' => $ewallet->id,
            ],

            // Transfer Bank
            [
                'kode_payment_provider' => 'PP-BCA',
                'nama_payment_provider' => 'BCA',
                'payment_method_id' => $transfer->id,
            ],
            [
                'kode_payment_provider' => 'PP-BNI',
                'nama_payment_provider' => 'BNI',
                'payment_method_id' => $transfer->id,
            ],
            [
                'kode_payment_provider' => 'PP-BRI',
                'nama_payment_provider' => 'BRI',
                'payment_method_id' => $transfer->id,
            ],
            [
                'kode_payment_provider' => 'PP-MANDIRI',
                'nama_payment_provider' => 'Mandiri',
                'payment_method_id' => $transfer->id,
            ],

        ];

        foreach ($providers as $provider) {
            PaymentProvider::create($provider);
        }
    }
}
