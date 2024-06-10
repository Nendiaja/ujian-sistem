<?php

namespace App\Models;

use App\Models\Soal;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    // use HasFactory;

    // deklarasi tabel
    public $table = 'nilai';

    //tipe data harus yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'nilai',
        'jawabanUser',
        'soal_id',
        'user_id',
        'kategori_id',
        
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class);
    }

}
