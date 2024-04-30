<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    protected $fillable = [
        'group',
        'lesson_id',
        'student_id',
        'attendance_type',
    ];

    protected $appends = ['student'];

//    public function students(){
//        return $this->belongsToMany(Student::class, 'subscriptions', 'lesson_id', 'student_id')->withPivot(
//            'group', 'attendance_type'
//        )->withTimeStamps();
//    }
//public function students()
//{
//    return $this->belongsToMany(Student::class, 'subscriptions', 'lesson_id', 'student_id')->withPivot(
//        'group', 'attendance_type'
//    )->withTimeStamps();
//}
//
//    public function groupStudents()
//    {
//        return $this->students()->groupBy('group');
//
//    }
    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function getGuideAttribute(): bool
    {
        return $this->attendance_type === 'attended';
    }

}
