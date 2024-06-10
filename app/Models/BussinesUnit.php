<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BussinesUnit extends Model
{
    // use HasFactory;

    // deklarasi tabel
    public $table = 'bussines_unit';

    //tipe data harus yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'nama',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class, 'bussines_unit_id');
    }
}
