<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @property $id
 * @property $kode_category
 * @property $nama_category
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Category extends Model
{
    use SoftDeletes;

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_category', 'nama_category'];

    public function menus()
    {
        return $this->hasMany(\App\Models\Menu::class, 'category_id', 'id');
    }

    protected static function booted(): void
    {
        static::creating(function ($category) {

            // Inisial nama (maksimal 3 huruf)
            $inisial = collect(explode(' ', trim($category->nama_category)))
                ->map(fn($kata) => strtoupper(substr($kata, 0, 1)))
                ->take(3)
                ->implode('');

            // Tanggal + Jam
            $tanggalJam = now()->format('dmHis');

            // Kode category
            $category->kode_category = $inisial . $tanggalJam;
        });
    }
}
