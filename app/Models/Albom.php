<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Albom extends Model
{
    use HasFactory;

    public function user_albom() {
        return $this->belongsTo(userAlbom::class);
    }
    public function track_alboms() {
        return $this->hasMany(trackAlbom::class);
    }
    public function genre_alboms() {
        return $this->hasMany(GenreAlbom::class);
    }
}
