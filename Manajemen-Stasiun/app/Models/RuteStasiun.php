<?php

namespace App\Models;

use App\Models\Rute;
use App\Models\Point;
use Illuminate\Database\Eloquent\Model;

class RuteStasiun extends Model
{
    protected $table = 'rute_stasiun';
    protected $fillable = ['rute_id', 'point_id', 'sequence'];

    public function rute()
    {
        return $this->belongsTo(Rute::class);
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}
