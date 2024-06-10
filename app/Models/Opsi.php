<?php

namespace App\Models;

use App\Models\Opsi;
use App\Models\Soal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opsi extends Model
{
    // use HasFactory;

    // deklarasi tabel
    public $table = 'opsi';

    //tipe data harus yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'a',
        'b',
        'c',
        'd',
        'jawaban',
        'soal_id',
        
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
