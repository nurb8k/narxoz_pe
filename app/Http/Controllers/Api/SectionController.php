<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {

        $sections = Section::with('lessons','teachers')->get();
        return SectionResource::collection($sections);
    }

    public function show(Section $section)
    {
        $section->load('lessons','teachers');
        return new SectionResource($section);
    }
}
