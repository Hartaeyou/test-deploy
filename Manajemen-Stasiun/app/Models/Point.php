<?php

namespace App\Models;

use App\Models\Rute;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $primaryKey = 'point_id';
    public $table = 'point';
    protected $fillable = ['nama', 'latitude', 'longitude'];

    public function rutes()
    {
        return $this->belongsToMany(Rute::class, 'rute_point', 'point_id', 'rute_id')
                    ->withPivot('sequence') // Ambil kolom 'urutan' dari tabel pivot
                    ->orderBy('pivot_sequence'); // Urutkan berdasarkan urutan
    }
}
