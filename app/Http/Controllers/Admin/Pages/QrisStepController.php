<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\QrisStep;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QrisStepController extends Controller
{
    public function index(): View
    {
        $steps = QrisStep::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.qris.steps.index', compact('steps'));
    }

    public function create(): View
    {
        return view('admin.pages.qris.steps.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        QrisStep::create($data);

        return redirect()
            ->route('admin.pages.qris.steps.index')
            ->with('status', 'Langkah QRIS berhasil ditambahkan.');
    }

    public function edit(QrisStep $step): View
    {
        return view('admin.pages.qris.steps.edit', compact('step'));
    }

    public function update(Request $request, QrisStep $step): RedirectResponse
    {
        $data = $this->validatedData($request);
        $step->update($data);

        return redirect()
            ->route('admin.pages.qris.steps.index')
            ->with('status', 'Langkah QRIS berhasil diperbarui.');
    }

    public function destroy(QrisStep $step): RedirectResponse
    {
        $step->delete();

        return redirect()
            ->route('admin.pages.qris.steps.index')
            ->with('status', 'Langkah QRIS berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}

