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

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_menu', 'nama_menu', 'harga', 'stok','satuan', 'foto_menu', 'category_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }

    protected static function booted(): void
    {
        static::creating(function ($menu) {

            // Inisial nama menu (maksimal 3 huruf)
            $inisialMenu = collect(explode(' ', trim($menu->nama_menu)))
                ->filter()
                ->map(fn($kata) => strtoupper(substr($kata, 0, 1)))
                ->take(3)
                ->implode('');

            // Ambil nama category
            $category = \App\Models\Category::find($menu->category_id);

            // Inisial category (1 huruf)
            $inisialCategory = $category
                ? strtoupper(substr($category->nama_category, 0, 1))
                : '';

            // Tanggal + Jam
            $tanggalJam = now()->format('dmHis');

            // Kode menu
            $menu->kode_menu = $inisialMenu . $inisialCategory . $tanggalJam;
        });
    }
}
