<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
class User extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['kode_user', 'foto_profile', 'nama_user', 'email', 'no_tlp', 'role', 'status', 'password'];


}
