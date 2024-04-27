<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NewsResource;
use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;

class EventController extends \App\Http\Controllers\Controller
{

    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return EventResource::collection(Event::all());
    }


}