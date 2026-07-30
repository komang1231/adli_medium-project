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
        Schema::create('transfer_banks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transfer_bank', 20)->unique();
            $table->string('nama_bank', 100);
            $table->string('no_rekening', 30);
            $table->string('nama_pemilik', 150);
            $table->foreignId('payment_provider_id')->constrained('payment_providers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_banks');
    }
};
