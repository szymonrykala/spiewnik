<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['title', 'lyrics', 'yt_link', 'ms_link', 'photo_url', 'is_public'];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($song) {
            if (auth()->check()) {
                $song->user_id = auth()->id();
                $song->updated_by = auth()->id();
            }
        });

        static::updating(function ($song) {
            if (auth()->check()) {
                $song->updated_by = auth()->id();
            }
        });
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function performances()
    {
        return $this->belongsToMany(Performance::class)
            ->withPivot(['position', 'target_date'])
            ->withTimestamps();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
