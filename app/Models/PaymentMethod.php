<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod
 *
 * @property $id
 * @property $kode_payment_method
 * @property $nama_payment_method
 * @property $created_at
 * @property $updated_at
 *
 * @property PaymentProvider[] $paymentProviders
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PaymentMethod extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_payment_method', 'nama_payment_method'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paymentProviders()
    {
        return $this->hasMany(\App\Models\PaymentProvider::class, 'id', 'payment_method_id');
    }
    
}
