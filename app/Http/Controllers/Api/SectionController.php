<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function list(){
        $sections = Section::query()->get();
       return SectionResource::collection($sections);
    }
}
