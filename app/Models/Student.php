<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'user_identifier',
        'gpa',
        'status',
        'group',
        'degree',
        'course_year',
        'gender',
        'attendance_count',
    ];

    protected $appends = ['user_type'];

    public function lessons(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'subscriptions', 'student_id', 'lesson_id')
            ->withPivot('attendance_type', 'group')
            ->withTimestamps();
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'reviews', 'student_id', 'teacher_id')
            ->withPivot('message', 'rating')
            ->withTimestamps();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_identifier', 'identifier');
    }

    public function getUserTypeAttribute(): string
    {
        return 'student';
    }
}
