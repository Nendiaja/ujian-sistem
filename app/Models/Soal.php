<?php

namespace App\Models;

use App\Models\Opsi;
use App\Models\Soal;
use App\Models\Nilai;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soal extends Model
{
    // use HasFactory;

    // deklarasi tabel
    public $table = 'soal';

    //tipe data harus yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'soal',
        'gambar',
        'poin',
        'kategori_id',
        
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function opsi()
    {
        return $this->hasMany(Opsi::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

}
