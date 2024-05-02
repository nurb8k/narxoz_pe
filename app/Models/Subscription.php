<?php

namespace App\Models;

use App\Enums\AttendanceType;
use App\Enums\Week;
use Carbon\Carbon;
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

//    protected $appends = ['student'];

//    public function students(){
//        return $this->belongsToMany(Student::class, 'subscriptions', 'lesson_id', 'student_id')->withPivot(
//            'group', 'attendance_type'
//        )->withTimeStamps();
//    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'subscriptions', 'lesson_id', 'student_id')->withPivot(
            'group', 'attendance_type'
        )->withTimeStamps();
    }

    public function whereGroupStudentCount($group): int
    {
        return $this->students()->where('group', $group)->count();
    }
//
//    public function groupStudents()
//    {
//        return $this->students()->groupBy('group');
//    }
    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function lesson(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function getParseAttendanceTypeAttribute(): string
    {
        $types = AttendanceType::getTypes();
        return $types[$this->attendance_type];
    }

    public function scopeGroupingInLesson($query){
        return $query->groupBy('group');
    }

    public function getGuideAttribute(): bool
    {
        return $this->attendance_type === 'attended';
    }

    public function getParseGroupAttribute(): string
    {
        //i need parse this group example: 08:00:00_friday_2022-04-14 to 14 апрель,2022 пятница 08:00 with Week Enum
        $days = Week::getWeekDayForKeys();
        $day = explode('_', $this->group)[1];
        $date = explode('_', $this->group)[2];
        $time = explode('_', $this->group)[0];
        $day = $days[$day];
        $date = date('d F, Y', strtotime($date));
        // date to russian
        $date = str_replace(
            ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'],
            $date
        );
//        $day = Week::getWeekDayForKey($day);

        return $date . ' ' . $day . ' ' . $time;

    }

}
