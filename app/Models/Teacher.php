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

    protected $appends = ['user_type'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_identifier', 'identifier');
    }

    public function lessons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lesson::class, 'teacher_id', 'id');
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
}
