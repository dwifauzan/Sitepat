<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keterlambatan extends Model
{
    use HasFactory;
    protected $fillable = ['Nisn_siswa', 'Tanggal'];
    protected $primarykey = 'id';

    public function datasiswa(){
        return $this->belongsTo(datasiswa::class, 'Nisn_siswa', 'Nisn');
    }
    public function jurusan(){
        return $this->belongsTo(jurusan::class);
    }
    public function kelas(){
        return $this->belongsTo(kelas::class);
    }
}
