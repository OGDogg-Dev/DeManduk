<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SopObjective;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SopObjectiveController extends Controller
{
    public function index(): View
    {
        $objectives = SopObjective::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.sop.objectives.index', compact('objectives'));
    }

    public function create(): View
    {
        return view('admin.pages.sop.objectives.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        SopObjective::create($data);

        return redirect()
            ->route('admin.pages.sop.objectives.index')
            ->with('status', 'Tujuan SOP berhasil ditambahkan.');
    }

    public function edit(SopObjective $objective): View
    {
        return view('admin.pages.sop.objectives.edit', compact('objective'));
    }

    public function update(Request $request, SopObjective $objective): RedirectResponse
    {
        $data = $this->validatedData($request);
        $objective->update($data);

        return redirect()
            ->route('admin.pages.sop.objectives.index')
            ->with('status', 'Tujuan SOP berhasil diperbarui.');
    }

    public function destroy(SopObjective $objective): RedirectResponse
    {
        $objective->delete();

        return redirect()
            ->route('admin.pages.sop.objectives.index')
            ->with('status', 'Tujuan SOP berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'content' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}

