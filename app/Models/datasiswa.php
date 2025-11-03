<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datasiswa extends Model
{
    use HasFactory;
    protected $table ='datasiswa';
    protected $fillable = ['id', 'Nisn', 'Nama_siswa', 'Jenis_kelamin', 'kelas_id', 'Jurusan_id', 'Alamat', 'No_Handphone', 'Nama_Ortu_Ayah', 'Nama_Ortu_Ibu', 'No_Handphone_Ayah', 'No_Handphone_Ibu', 'created_at', 'updated_at'];
    public function kelas(){
        return $this->belongsTo(kelas::class);
    }
    public function jurusan(){
        return $this->belongsTo(jurusan::class);
    }

    // ini adalah relasi keterlambatan
    public function keterlambatan(){
        return $this->hasMany(keterlambatan::class);
    }
}
