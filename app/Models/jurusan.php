<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;
    protected $table ='jurusan';

    protected $fillable = [ 'id', 'Nama_jurusan', 'Nama_kaproli', 'created_at', 'updated_at'];
    public function datasiswa(){
        return $this->hasMany(datasiswa::class);
    }

    public function keterlambatan(){
        return $this->hasMany(keterlambatan::class);
    }
}
