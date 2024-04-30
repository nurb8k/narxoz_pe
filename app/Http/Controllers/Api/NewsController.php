<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources as Resources;
use App\Http\Resources\NewsResource;
use App\Http\Resources\TeacherResource;
use App\Models as Models;
use Filament\Resources\Resource;
use Illuminate\Http\Request;

class NewsController extends \App\Http\Controllers\Controller
{

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $news = Models\News::query()
            ->with('sections')
            ->latest()
            ->paginate(7);
        return Resources\News\ListResource::collection($news);
    }

    public function show(Models\News $news): Resources\News\ShowResource
    {
        $news->load('sections');
        return Resources\News\ShowResource::make($news);
    }


}