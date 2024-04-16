<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';
    protected $fillable = [
      'section_id',
      'teacher_id',
      'title',
      'characteristics',
      'description',
      'poster',
      'status',
      'type',
      'start_time',
      'end_time',
      'start_date',
      'capacity',
      'day_of_week',
      'place_id',
    ];

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}
