<?php


namespace App\Enums;
class Week
{

    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 0;



    public static function getWeekDays()
    {
        return [
            self::MONDAY => 'monday',
            self::TUESDAY => 'tuesday',
            self::WEDNESDAY => 'wednesday',
            self::THURSDAY => 'thursday',
            self::FRIDAY => 'friday',
            self::SATURDAY => 'saturday',
            self::SUNDAY => 'sunday',
        ];
    }

    public static function getWeekDayForKeys()
    {
        return [
            'monday' => 'Понедельник',
            'tuesday' => 'Вторник',
            'wednesday' => 'Среда',
            'thursday' => 'Четверг',
            'friday' => 'Пятница',
            'saturday' => 'Суббота',
            'sunday' => 'Воскресенье',
        ];
    }

    public static function getWeekDay($day): string
    {
        $days = self::getWeekDays();
        return $days[$day];
    }

    public static function getWeekDayForKey($day): string
    {
        $days = self::getWeekDayForKeys();
        return $days[$day];
    }
}



