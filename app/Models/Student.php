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
}
