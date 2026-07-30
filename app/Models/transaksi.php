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
        return $this->belongsTo(\App\Models\TransferBank::class, 'transfer_bank_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransakses()
    {
        return $this->hasMany(\App\Models\DetailTransaksi::class, 'id', 'transaksi_id');
    }
    
}
