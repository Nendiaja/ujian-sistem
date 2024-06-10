<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriUser extends Model
{
   // deklarasi tabel
   public $table = 'kategori_user';

   //tipe data harus yyyy-mm-dd hh:mm:ss
   protected $dates = [
       'created_at',
       'updated_at',
       'deleted_at'
   ];

   protected $fillable = [
       'kategori_id',
       'user_id',
       'status',
       'nilai_total'
   ];

   public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
