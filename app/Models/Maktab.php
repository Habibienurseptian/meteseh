<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maktab extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi_rumah',
        'alamat_rumah',
        'nama_pemilik',
        'nomor_telepon',
        'kapasitas_penghuni',
        'sisa_kapasitas',
    ];

     public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}