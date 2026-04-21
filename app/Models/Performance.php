<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['name', 'description', 'performance_date'];

    protected $casts = [
        'performance_date' => 'date',
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class)
            ->withPivot(['position', 'target_date'])
            ->orderBy('pivot_position');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
