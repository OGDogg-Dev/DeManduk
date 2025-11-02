<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::query()
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->paginate(12)
            ->withQueryString();

        return view('public.event.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('public.event.show', compact('event'));
    }
}
