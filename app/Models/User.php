<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property $id
 * @property $kode_user
 * @property $foto_profile
 * @property $nama_user
 * @property $email
 * @property $no_tlp
 * @property $role
 * @property $password
 * @property $status
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */



class User extends Authenticatable
{
    use SoftDeletes;

    

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_user', 'foto_profile', 'nama_user', 'email', 'no_tlp', 'role', 'status', 'password'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function createdUsers()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    protected static function booted(): void
    {
        static::creating(function ($akun) {

            // Prefix jabatan
            $prefix = match ($akun->role) {
                'Admin' => 'ADM',
                'Manager' => 'MGN',
                'Staff' => 'STF',
                default => 'STF',
            };

            // Inisial nama (maksimal 3 huruf)
            $inisial = collect(explode(' ', trim($akun->nama_user)))
                ->filter()
                ->map(fn($kata) => strtoupper(substr($kata, 0, 1)))
                ->take(3)
                ->implode('');

            // Ambil angka pertama dari nomor telepon
            $angkaDepan = substr(preg_replace('/\D/', '', $akun->no_tlp), 0, 1);

            // Tanggal + Jam
            $tanggalJam = now()->format('dmHis');

            // Kode user
            $akun->kode_user = $prefix . $inisial . $angkaDepan . $tanggalJam;
        });
    }
}
