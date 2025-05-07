<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = ['from_chapter_id', 'to_chapter_id', 'text', 'code'];

    public function fromChapter()
    {
        return $this->belongsTo(Chapter::class, 'from_chapter_id');
    }

    public function toChapter()
    {
        return $this->belongsTo(Chapter::class, 'to_chapter_id');
    }
}
