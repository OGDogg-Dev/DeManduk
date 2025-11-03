<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SopStep;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SopStepController extends Controller
{
    public function index(): View
    {
        $steps = SopStep::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.sop.steps.index', compact('steps'));
    }

    public function create(): View
    {
        return view('admin.pages.sop.steps.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        SopStep::create($data);

        return redirect()
            ->route('admin.pages.sop.steps.index')
            ->with('status', 'Langkah SOP berhasil ditambahkan.');
    }

    public function edit(SopStep $step): View
    {
        return view('admin.pages.sop.steps.edit', compact('step'));
    }

    public function update(Request $request, SopStep $step): RedirectResponse
    {
        $data = $this->validatedData($request);
        $step->update($data);

        return redirect()
            ->route('admin.pages.sop.steps.index')
            ->with('status', 'Langkah SOP berhasil diperbarui.');
    }

    public function destroy(SopStep $step): RedirectResponse
    {
        $step->delete();

        return redirect()
            ->route('admin.pages.sop.steps.index')
            ->with('status', 'Langkah SOP berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'items' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $items = Collection::make(preg_split("/\r?\n/", $data['items'] ?? ''))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        $data['items'] = $items;
        $data['sort_order'] = isset($data['sort_order']) ? (int) $data['sort_order'] : 0;

        return $data;
    }
}

