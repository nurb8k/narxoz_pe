<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image'];

    public function sections(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'news_sections', 'news_id', 'section_id')
            ->withPivot('content')
            ->withTimestamps();
    }


}
