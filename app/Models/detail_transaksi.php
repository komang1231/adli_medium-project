<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail_Transaksi extends Model
{
    use SoftDeletes;

    protected $table = 'detail_transaksis';

    protected $fillable = [
        'kode_detail_transaksi',
        'transaksi_id',
        'menu_id',
        'jumlah',
        'harga_satuan',
        'subtotal_harga',
    ];

    protected static function booted(): void
    {
        static::creating(function ($detailTransaksi) {

            // Inisial nama menu (maksimal 3 huruf)
            $inisialMenu = collect(explode(' ', trim($detailTransaksi->nama_menu)))
                ->filter()
                ->map(fn($kata) => strtoupper(substr($kata, 0, 1)))
                ->take(3)
                ->implode('');

            // Ambil nama category
            $member = \App\Models\Member::find($detailTransaksi->member_id);
            $inisialMember = $member
                ? strtoupper(substr($member->nama_pelanggan, 0, 1))
                : '';

            

            // Tanggal + Jam
            $tanggalJam = now()->format('dmHis');

            // Kode menu
            $detailTransaksi->kode_detail_transaksi = $inisialMenu . $inisialMember . $tanggalJam;
        });
    }
}
