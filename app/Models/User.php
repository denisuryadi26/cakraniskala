<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Models;

use App\Models\Generator\Agama;
use App\Models\Generator\Category;
use App\Models\Generator\Sabuk;
use App\Models\Generator\Unlat;
use DigitalCloud\Blameable\Traits\Blameable;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements Auditable, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use Uuid;
    use Blameable;
    use \OwenIt\Auditing\Auditable;


    protected $table = 'conf_users';
    protected $primaryKey = 'id';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'group_id',
        'nik',
        'code',
        'fullname',
        'username',
        'alamat',
        'agama_id',
        'tempat_lahir',
        'tgl_lahir',
        'sabuk_id',
        'unlat_id',
        'kategori_id',
        'email',
        'no_hp',
        'password',
        'profile_picture',
        'dokument',
        'kta',
        'status',
        'is_kta',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCollect()
    {
        return [
            'username' => $this->attributes['username'],
            'password' => $this->attributes['password'],
            'approval_status' => $this->attributes['approval_status'],
            'phone_number' => $this->attributes['phone_number'],
            'profile_picture' => $this->attributes['profile_picture'],
        ];
    }


    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function unlat()
    {
        return $this->hasOne(Unlat::class, 'id', 'unlat_id');
    }

    public function agama()
    {
        return $this->hasOne(Agama::class, 'id', 'agama_id');
    }

    public function kategori()
    {
        return $this->hasOne(Category::class, 'id', 'kategori_id');
    }

    public function sabuk()
    {
        return $this->hasOne(Sabuk::class, 'id', 'sabuk_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
