<?php

namespace App\Http\Controllers\Api;

use App\Enums\Week;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonSubscribeRequest;
use App\Http\Resources as Resources;
use App\Models as Models;
use Carbon\Carbon;

class SectionController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $sections = Models\Section::with('lessons', 'teachers')->get();
        return Resources\Section\ListResource::collection($sections);
    }

    public function show(Models\Section $section)
    {
        $section->load('lessons', 'teachers');
        return Resources\Section\ShowResource::make($section);
    }

}
