<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NewsResource;
use App\Http\Resources\TeacherResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends \App\Http\Controllers\Controller
{

    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $section = $request->section;

        $news = News::whereHas('sections', function ($query) use ($section) {
            $query->where('title', $section); // Проверяем, что у раздела имя совпадает с переданным значением
        })->get();

        return NewsResource::collection($news);
    }

    public function show(\App\Models\Teacher $news): TeacherResource
    {
        $news->load('sections');
        return new TeacherResource($news);
    }


}