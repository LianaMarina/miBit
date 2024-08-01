<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function track_albom() {
        return $this->belongsTo(trackAlbom::class);
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }
    
    public function person_tracks() {
        return $this->hasMany(personTrack::class);
    }

    public function track_playlists() {
        return $this->hasMany(trackPlaylist::class);
    }
}
