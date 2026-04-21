<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Tag::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Tag::class, 'parent_id');
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }
}
