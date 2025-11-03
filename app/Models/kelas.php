<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'Tingkat_kelas', 'Nama_kelas', 'Walikelas', 'created_at', 'updated_at'];
    public function datasiswa(){
        return $this->hasMany(datasiswa::class);
    }

    public function keterlambatan(){
        return $this->hasMany(keterlambatan::class);
    }
}
