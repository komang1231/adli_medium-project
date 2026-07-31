<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Member
 *
 * @property $id
 * @property $kode_pelanggan
 * @property $nama_pelanggan
 * @property $no_tlp
 * @property $status
 * @property $expired_at
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Member extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_pelanggan', 'nama_pelanggan', 'no_tlp', 'status', 'expired_at'];

    protected static function booted(): void
{
    static::creating(function ($member) {

        // Inisial nama member (maksimal 3 huruf)
        $inisial = collect(explode(' ', trim($member->nama_pelanggan)))
            ->filter()
            ->map(fn ($kata) => strtoupper(substr($kata, 0, 1)))
            ->take(3)
            ->implode('');

        // Ambil angka pertama dari nomor telepon
        $angkaDepan = substr(preg_replace('/\D/', '', $member->no_tlp), 0, 1);

        // Tanggal + Jam
        $tanggalJam = now()->format('dmHis');

        // Kode member
        $member->kode_pelanggan = $inisial . $angkaDepan . $tanggalJam;

    });
}

}
