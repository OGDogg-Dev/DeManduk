<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresMedia;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    use StoresMedia;

    public function index(): View
    {
        $events = Event::query()
            ->orderByDesc('event_date')
            ->orderByDesc('start_time')
            ->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $event = new Event();
        $data = $this->validatedData($request, $event);
        $this->persistEvent($event, $data, $request);

        return redirect()->route('admin.events.index')
            ->with('status', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $this->validatedData($request, $event);
        $this->persistEvent($event, $data, $request);

        return redirect()->route('admin.events.index')
            ->with('status', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->deleteStoredFile($event->cover_image);
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('status', 'Event berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Event $event = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash'],
            'category' => ['nullable', 'string', 'max:100'],
            'event_date' => ['nullable', 'date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'location' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'published_toggle' => ['nullable', 'boolean'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'remove_cover_image' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $data['slug'] ?: ($event?->slug ?? Str::slug($data['title']));

        $slugQuery = Event::where('slug', $data['slug']);
        if ($event?->exists) {
            $slugQuery->where('id', '!=', $event->id);
        }
        if ($slugQuery->exists()) {
            $data['slug'] = Str::slug($data['slug'] . '-' . Str::random(4));
        }

        foreach (['start_time', 'end_time'] as $field) {
            if (! empty($data[$field])) {
                $data[$field] = $data[$field] . ':00';
            } else {
                $data[$field] = null;
            }
        }

        $data['event_date'] = $data['event_date'] ?? null;

        if (! empty($data['published_toggle'])) {
            $data['published_at'] = $event?->published_at ?? now();
        } else {
            $data['published_at'] = null;
        }

        $data['remove_cover_image'] = ! empty($data['remove_cover_image']);

        unset($data['published_toggle']);

        return $data;
    }

    private function persistEvent(Event $event, array $data, Request $request): void
    {
        $coverImagePath = $event->cover_image;

        if ($data['remove_cover_image'] && $coverImagePath) {
            $this->deleteStoredFile($coverImagePath);
            $coverImagePath = null;
        }

        if ($request->hasFile('cover_image')) {
            $coverImagePath = $this->storeUploadedFile($request, 'cover_image', 'events', $event->cover_image);
        }

        unset($data['cover_image'], $data['remove_cover_image']);

        $event->fill($data + ['cover_image' => $coverImagePath]);

        $event->save();
    }
}
