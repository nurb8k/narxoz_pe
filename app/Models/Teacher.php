<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable = [
        'user_identifier',
        'short_info',
        'about',
        'experience_year',
    ];

    protected $appends = ['user_type','fio'];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_identifier', 'identifier');
    }

    public function lessons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lesson::class, 'teacher_id', 'id');
    }

    public function groups()
    {
//        return $this->hasManyThrough(Lesson::class, Subscription::class)
        $lessonIds = $this->lessons()->pluck('id');
        return Subscription::whereIn('lesson_id', $lessonIds);

    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'reviews',
            'teacher_id', 'student_id')
            ->withPivot('message', 'rating')
            ->withTimestamps();
    }

    public function getUserTypeAttribute(): string
    {
        return 'teacher';
    }

    public function getFioAttribute() : string
    {
        return $this->user->name. ' ' . $this->user->surname;
    }

    public function sections(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'teacher_syllabus', 'teacher_id', 'section_id')
            ->withPivot('content', 'syllabus')
            ->withTimestamps();
    }
}
