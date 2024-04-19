<?php

namespace App\Http\Controllers\Api;
class TeacherController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        $teachers = \App\Models\Teacher::with('user','reviews')->get();
    }
}