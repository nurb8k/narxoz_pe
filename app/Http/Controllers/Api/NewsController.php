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
        $section = $request->section; //order by section
        $news = News::query()
            ->whereHas('sections', function ($query) use ($section) {
                $query->where('title', $section);
            })
            ->with('sections')
            ->latest()
            ->get();
        return NewsResource::collection($news);
    }

    public function show(News $news): NewsResource
    {
        $news->load('sections');
        return NewsResource::make($news);
    }


}