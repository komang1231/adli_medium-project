<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaksi
 *
 * @property $id
 * @property $kode_transaksi
 * @property $status_pesanan
 * @property $member_id
 * @property $tipe_pelanggan
 * @property $nama_pelanggan
 * @property $no_tlp
 * @property $payment_method_id
 * @property $payment_provider_id
 * @property $transfer_bank_id
 * @property $ppn
 * @property $harga_ppn
 * @property $service_charge
 * @property $harga_service_charge
 * @property $diskon_member
 * @property $harga_diskon_member
 * @property $grand_total
 * @property $user_id
 * @property $paid_at
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Member $member
 * @property PaymentMethod $paymentMethod
 * @property PaymentProvider $paymentProvider
 * @property TransferBank $transferBank
 * @property User $user
 * @property DetailTransaksi[] $detailTransakses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Transaksi extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_transaksi', 'status_pesanan', 'member_id', 'tipe_pelanggan', 'nama_pelanggan', 'no_tlp', 'payment_method_id', 'payment_provider_id', 'transfer_bank_id', 'ppn', 'harga_ppn', 'service_charge', 'harga_service_charge', 'diskon_member', 'harga_diskon_member', 'grand_total', 'user_id', 'paid_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(\App\Models\Member::class, 'member_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(\App\Models\PaymentMethod::class, 'payment_method_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentProvider()
    {
        return $this->belongsTo(\App\Models\PaymentProvider::class, 'payment_provider_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transferBank()
    {
        return $this->belongsTo(\App\Models\Transfer_Bank::class, 'transfer_bank_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(\App\Models\detail_transaksi::class, 'transaksi_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransakses()
    {
        return $this->items();
    }

    public function getStatusAttribute()
    {
        return $this->status_pesanan;
    }

    public function getIsMemberAttribute()
    {
        return $this->tipe_pelanggan === 'Member';
    }

    // public function getPaymentMethodAttribute()
    // {
    //     return $this->paymentMethod?->nama_payment_method;
    // }

    // public function getPaymentProviderAttribute()
    // {
    //     return $this->paymentProvider?->nama_payment_provider;
    // }

    public function getNamaBankAttribute()
    {
        return $this->transferBank?->nama_bank;
    }

    public function getNoRekeningAttribute()
    {
        return $this->transferBank?->no_rekening;
    }

    public function getNamaPemilikRekeningAttribute()
    {
        return $this->transferBank?->nama_pemilik_rekening;
    }

    public function getSubtotalAttribute()
    {
        return $this->items->sum('subtotal_harga');
    }

    public function getServiceChargeAttribute()
    {
        return $this->harga_service_charge;
    }

    public function getPpnAttribute()
    {
        return $this->harga_ppn;
    }


    protected static function booted(): void
{
    static::creating(function ($transaksi) {

        // Inisial nama pelanggan (maksimal 3 huruf)
        $inisialPelanggan = collect(explode(' ', trim($transaksi->nama_pelanggan)))
            ->filter()
            ->map(fn ($kata) => strtoupper(substr($kata, 0, 1)))
            ->take(3)
            ->implode('');

        // Angka pertama nomor telepon
        $angkaNoTlp = substr(preg_replace('/\D/', '', $transaksi->no_tlp), 0, 1);

        // Ambil payment method
        $paymentMethod = \App\Models\PaymentMethod::find($transaksi->payment_method_id);
        $inisialPaymentMethod = $paymentMethod
            ? strtoupper(substr($paymentMethod->nama_payment_method, 0, 1))
            : '';

        // Ambil payment provider
        $paymentProvider = \App\Models\PaymentProvider::find($transaksi->payment_provider_id);
        $inisialPaymentProvider = $paymentProvider
            ? strtoupper(substr($paymentProvider->nama_payment_provider, 0, 1))
            : '';

        // Angka pertama grand total
        $angkaGrandTotal = substr((string) $transaksi->grand_total, 0, 1);

        // Ambil user
        $user = \App\Models\User::find($transaksi->user_id);

        // Inisial nama user
        $inisialUser = $user
            ? collect(explode(' ', trim($user->name)))
                ->filter()
                ->map(fn ($kata) => strtoupper(substr($kata, 0, 1)))
                ->take(3)
                ->implode('')
            : '';

        // Inisial role user
        $inisialRole = match ($user?->role) {
            'Admin' => 'ADM',
            'Manager' => 'MGN',
            'Staff' => 'STF',
            default => 'USR',
        };

        // Tanggal + Jam
        $tanggalJam = now()->format('dmHis');

        // Kode transaksi
        $transaksi->kode_transaksi =
            $inisialPelanggan .
            $angkaNoTlp .
            $inisialPaymentMethod .
            $inisialPaymentProvider .
            $angkaGrandTotal .
            $inisialUser .
            $inisialRole .
            $tanggalJam;
    });
}
    
}
