<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Kategori;
use App\Models\BussinesUnit;
use App\Models\KategoriUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'SAP',
        'name',
        'BU',
        'department',
        'password',
        'kategori_id',
        'role',
        'pic',
    ];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_user', 'user_id', 'kategori_id')->withPivot('user_id', 'kategori_id');
    }
    

    public function kategoriUser()
    {
        return $this->hasMany(KategoriUser::class);
    }

    public function bussines_unit()
    {
        return $this->belongsTo(BussinesUnit::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin'; // Ubah ini sesuai dengan cara Anda menentukan peran admin dalam aplikasi Anda
    }

    public function isUser()
    {
        return $this->role === 'user'; // Sesuaikan dengan cara Anda menentukan peran pengguna biasa
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
