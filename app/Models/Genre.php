<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public function tracks() {
        return $this->hasMany(Track::class);
    }

    public function user_genres() {
        return $this->hasMany(UserGenre::class);
    }

    public function genre_alboms() {
        return $this->hasMany(GenreAlbom::class);
    }
}
