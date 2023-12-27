<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan'; 

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tanggal_lahir',
        'tanggal_bergabung',
        'status',
        'department',
        'nomor_hp',
    ];

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = date('Y-m-d', strtotime($value));
    }


    public function getUmurAttribute()
    {
        return date_diff(date_create($this->attributes['tanggal_lahir']), date_create('today'))->y;
    }
}
