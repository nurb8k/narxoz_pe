<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $fillable = [
        'title',
        'description',
        'icon',
        'status'
    ];

    public function lessons(){
        return $this->hasMany(Lesson::class, 'section_id', 'id');
    }
}
