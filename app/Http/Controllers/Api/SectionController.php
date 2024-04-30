<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Section as Section;
use App\Models as Models;

class SectionController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $sections = Models\Section::with('lessons','teachers')->get();
        return Section\ListResource::collection($sections);
    }

    public function show(Models\Section $section): Section\ShowResource
    {
        $section->load('lessons','teachers');
        return new Section\ShowResource($section);
    }
}
