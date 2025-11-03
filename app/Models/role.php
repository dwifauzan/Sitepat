<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nama_role', 'created_at', 'updated_at'];
    public function user(){
        return $this->hasMany(User::class);
    }
}
