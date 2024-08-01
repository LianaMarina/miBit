<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trackAlbom extends Model
{
    use HasFactory;

    public function track() {
        return $this->belongsTo(Track::class);
    }

    public function albom() {
        return $this->belongsTo(Albom::class);
    }
}
