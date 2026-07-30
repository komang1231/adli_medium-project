<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->string('kode_transaksi', 30)->unique();

            $table->enum('status_pesanan', ['unpaid', 'paid'])
                ->default('unpaid');

            $table->foreignId('member_id')
                ->nullable()
                ->constrained('members');

            $table->enum('tipe_pelanggan', ['Member', 'Non-Member']);

            $table->string('nama_pelanggan', 150);
            $table->string('no_tlp', 13);

            $table->foreignId('payment_method_id')
                ->constrained('payment_methods');

            $table->foreignId('payment_provider_id')
                ->constrained('payment_providers');

            $table->foreignId('transfer_bank_id')
                ->nullable()
                ->constrained('transfer_banks');

            $table->decimal('ppn', 5, 2);
            $table->decimal('harga_ppn', 15, 2);

            $table->decimal('service_charge', 5, 2);
            $table->decimal('harga_service_charge', 15, 2);

            $table->decimal('diskon_member', 5, 2)
                ->nullable();

            $table->decimal('harga_diskon_member', 15, 2)
                ->nullable();

            $table->decimal('grand_total', 15, 2);

            $table->foreignId('user_id')
                ->constrained('users');

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
