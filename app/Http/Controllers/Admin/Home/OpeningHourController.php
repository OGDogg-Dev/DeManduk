<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeOpeningHour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OpeningHourController extends Controller
{
    public function index(): View
    {
        $hours = HomeOpeningHour::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.home.hours.index', compact('hours'));
    }

    public function create(): View
    {
        return view('admin.home.hours.create');
    }

    public function store(Request $request): RedirectResponse
    {
        HomeOpeningHour::create($this->validatedData($request));

        return redirect()->route('admin.home.hours.index')
            ->with('status', 'Jam operasional berhasil ditambahkan.');
    }

    public function edit(HomeOpeningHour $hour): View
    {
        return view('admin.home.hours.edit', compact('hour'));
    }

    public function update(Request $request, HomeOpeningHour $hour): RedirectResponse
    {
        $hour->update($this->validatedData($request));

        return redirect()->route('admin.home.hours.index')
            ->with('status', 'Jam operasional berhasil diperbarui.');
    }

    public function destroy(HomeOpeningHour $hour): RedirectResponse
    {
        $hour->delete();

        return redirect()->route('admin.home.hours.index')
            ->with('status', 'Jam operasional berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'hours' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}
