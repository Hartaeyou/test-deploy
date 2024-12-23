<?php

namespace App\Models;

use App\Models\Rute;
use Illuminate\Database\Eloquent\Model;

class Kereta extends Model
{
    protected $primaryKey = 'kereta_id';
    protected $table = 'kereta'; // Nama tabel
    protected $fillable = ['nama_kereta', 'kode_kereta', 'rute_id']; // Kolom yang bisa diisi

    /**
     * Relasi ke model Rute.
     * Setiap kereta memiliki satu rute.
     */
    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rute_id');
    }
}
