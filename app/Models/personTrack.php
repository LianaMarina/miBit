<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personTrack extends Model
{
    use HasFactory;

    public function track() {
        return $this->belongsTo(Track::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
