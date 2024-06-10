<?php

namespace App\Models;

use App\Models\Soal;
use App\Models\User;
use App\Models\Nilai;
use App\Models\KategoriUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    // use HasFactory;

    // deklarasi tabel
    public $table = 'kategori';

    //tipe data harus yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'nama',
        
    ];

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function nilai()
    {
        return $this->belongsToMany(Nilai::class);
    }

    public function kategoriUsers()
    {
        return $this->hasMany(KategoriUser::class);
    }

    

}
