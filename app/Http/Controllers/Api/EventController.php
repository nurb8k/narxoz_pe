<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Event\ListResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        return ListResource::collection(Event::query()->latest()->get());
    }


}