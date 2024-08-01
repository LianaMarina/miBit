<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlaylist extends Model
{
    use HasFactory;

    public function playlists() {
        return $this->hasMany(Playlist::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
