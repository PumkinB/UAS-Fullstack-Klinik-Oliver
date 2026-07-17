<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    
    protected $fillable = ['pasien_id', 'jadwal_id', 'tanggal_periksa', 'keluhan', 'diagnosis_hasil', 'status'];

    // Relasi ke Pasien dan Jadwal
    public function pasien() {
        return $this->belongsTo(Pasien::class);
    }
    public function jadwal() {
        return $this->belongsTo(Jadwal::class);
    }
}