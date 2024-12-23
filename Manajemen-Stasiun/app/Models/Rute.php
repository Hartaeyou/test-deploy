<?php

namespace App\Models;

use App\Models\Point;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $primaryKey = 'rute_id';
    protected $table = 'rute'; // Nama tabel
    protected $fillable = ['rute_1', 'rute_2']; // Kolom yang bisa diisi

    /**
     * Relasi ke model Point (stasiun).
     * Banyak point terkait dengan rute.
     */
    public function points()
    {
        return $this->belongsToMany(Point::class, 'rute_stasiun', 'rute_id', 'point_id',)
                    ->withPivot('sequence')
                    ->orderBy('pivot_sequence');
    }



    /**
     * Relasi ke model Kereta.
     * Satu rute bisa memiliki banyak kereta.
     */
    public function keretas()
    {
        return $this->hasMany(Kereta::class, 'rute_id');
    }
}
