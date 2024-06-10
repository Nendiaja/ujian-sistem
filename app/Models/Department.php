<?php

namespace App\Models;

use App\Models\BussinesUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    public $table = 'department';

    //tipe data harus yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'nama',
        'bussines_unit_id',
    ];

     // Relasi Many-to-One dengan BussineUnit
     public function bussinesUnit()
     {
         return $this->belongsTo(BussinesUnit::class, 'bussines_unit_id');
     }
}
