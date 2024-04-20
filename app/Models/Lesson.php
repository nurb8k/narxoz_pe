<?php

namespace App\Models;

use App\Http\Resources\LessonResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';
    protected $fillable = [
        'id',
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

    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function place(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function students(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'subscriptions', 'lesson_id', 'student_id')->withPivot(
            'group', 'attendance_type'
        )->withTimeStamps();
    }

    public function groupSubscriptions()
    {
        return $this->hasMany(Subscription::class, 'lesson_id', 'id');

    }

    public function groupStudents($group)
    {
        return $this->students()->wherePivot('group', $group);
    }


    public function getGroupDate($group_date): string
    {
        $start_time = $this->start_time;
        $week_of_day = $this->day_of_week;
        $date = date('Y-m-d', strtotime($group_date));

        return $start_time . '_' . $week_of_day . '_' . $date;
    }

//    public function getIsAvailableAttribute()
//    {
//        dd($this);
//        return $this->is_available;
////        $dateTime = Carbon::parse($data . ' ' . $this->start_time);
////        $now = Carbon::now();
////
////        $oneHourFromNow = $now->copy()->addHour();
////        $twoMonthsFromNow = $now->copy()->addMonths(2);
////
////        if ($now->gt($dateTime) || $oneHourFromNow->gt($dateTime)) {
////            // Если занятие уже прошло или начнется менее чем через час,
////            // не разрешаем подписываться
////            return false;
////        }
////
////        if ($twoMonthsFromNow->gt($dateTime)) {
////            // Если занятие начнется через более чем 2 месяца, разрешаем подписываться
//////            dd('ok');
////            return true;
////        }
//////        abort(403, 'Слишком рано подписываться на это занятие.');
////            return false;
//
//    }
    public function setIsAvailableAttribute($data)
    {
        $dateTime = Carbon::parse($data . ' ' . $this->start_time);
        $now = Carbon::now();

        $oneHourFromNow = $now->copy()->addHour();
        $twoMonthsFromNow = $now->copy()->addMonths(2);

        if ($now->gt($dateTime) || $oneHourFromNow->gt($dateTime)) {
            // Если занятие уже прошло или начнется менее чем через час,
            // не разрешаем подписываться
            $this->attributes['is_available'] = false;
//            return false;
        }

        if ($twoMonthsFromNow->gt($dateTime)) {

            // Если занятие начнется через более чем 2 месяца, разрешаем подписываться
//            dd('ok');
            $this->attributes['is_available'] = true;
//            return true;
        }else{

            $this->attributes['is_available'] = false;
        }
//        abort(403, 'Слишком рано подписываться на это занятие.');
//        return false;

    }

}

