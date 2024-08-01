<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreAlbom extends Model
{
    use HasFactory;

    public function alboms() {
        return $this->hasMany(Albom::class);
    }
    public function genres() {
        return $this->hasMany(Genre::class);
    }
}
