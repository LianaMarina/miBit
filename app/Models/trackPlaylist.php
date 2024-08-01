<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trackPlaylist extends Model
{
    use HasFactory;

    public function tracks() {
        return $this->hasMany(Track::class);
    }

    public function playlists() {
        return $this->hasMany(Playlist::class);
    }
}
