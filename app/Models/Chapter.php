<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['story_id', 'title', 'content', 'is_first', 'is_ending', 'ending_type'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class, 'from_chapter_id');
    }
}
