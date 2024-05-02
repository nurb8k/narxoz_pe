<?php


namespace App\Enums;
class AttendanceType
{

    const ATTENDED = 'attended';
    const MISSED = 'missed';
    const WAITING = 'waiting';

    public static function getTypes()
    {
        return [
            self::ATTENDED => 'Присутствовал',
            self::MISSED => 'Отсутствовал',
            self::WAITING => 'Ожидается',
        ];
    }
}



