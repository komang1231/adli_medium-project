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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();

            $table->string('kode_detail_transaksi', 30)->unique();

            $table->foreignId('transaksi_id')
                ->constrained('transaksis');

            $table->foreignId('menu_id')
                ->constrained('menus');

            $table->integer('jumlah');

            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('subtotal_harga', 10, 2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
