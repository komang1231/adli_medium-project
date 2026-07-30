<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentProvider
 *
 * @property $id
 * @property $kode_payment_provider
 * @property $payment_method_id
 * @property $nama_payment_provider
 * @property $created_at
 * @property $updated_at
 *
 * @property PaymentMethod $paymentMethod
 * @property TransferBank[] $transferBanks
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PaymentProvider extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_payment_provider', 'payment_method_id', 'nama_payment_provider'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(\App\Models\PaymentMethod::class, 'payment_method_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transferBanks()
    {
        return $this->hasMany(\App\Models\TransferBank::class, 'id', 'payment_provider_id');
    }
    
}
