<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::query()
            ->published()
            ->orderBy('event_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(12)
            ->withQueryString();

        return view('public.event.index', compact('events'));
    }

    public function show(Event $event)
    {
        abort_unless($event->published_at, 404);

        return view('public.event.show', compact('event'));
    }
}
