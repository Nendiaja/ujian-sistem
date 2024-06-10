<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
     // deklarasi tabel
     public $table = 'setting';

     //tipe data harus yyyy-mm-dd hh:mm:ss
     protected $dates = [
         'created_at',
         'updated_at',
         'deleted_at'
     ];
 
     protected $fillable = [
         'rules',
         'pengumuman',
     ];
}
