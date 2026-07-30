<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menu
 *
 * @property $id
 * @property $kode_menu
 * @property $nama_menu
 * @property $harga
 * @property $stok
 * @property $foto_menu
 * @property $category_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Category $category
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Menu extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_menu', 'nama_menu', 'harga', 'stok', 'foto_menu', 'category_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }
    
}
