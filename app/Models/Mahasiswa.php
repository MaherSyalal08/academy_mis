<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nrp';
    protected $fillable = ['nrp', 'name', 'email', 'birth_date', 'phone', 'address', 'profile_picture', 'dosen_nik'];
    protected $keyType = 'String';
    public $incrementing = false;

    protected $timestamp = false;

    public function dosenWali(){ 
        return $this->belongsTo(Dosen::class, 'dosen_nik');
    }
}   
