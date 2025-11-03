<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\QrisNote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QrisNoteController extends Controller
{
    public function index(): View
    {
        $notes = QrisNote::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.qris.notes.index', compact('notes'));
    }

    public function create(): View
    {
        return view('admin.pages.qris.notes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        QrisNote::create($data);

        return redirect()
            ->route('admin.pages.qris.notes.index')
            ->with('status', 'Catatan QRIS berhasil ditambahkan.');
    }

    public function edit(QrisNote $note): View
    {
        return view('admin.pages.qris.notes.edit', compact('note'));
    }

    public function update(Request $request, QrisNote $note): RedirectResponse
    {
        $data = $this->validatedData($request);
        $note->update($data);

        return redirect()
            ->route('admin.pages.qris.notes.index')
            ->with('status', 'Catatan QRIS berhasil diperbarui.');
    }

    public function destroy(QrisNote $note): RedirectResponse
    {
        $note->delete();

        return redirect()
            ->route('admin.pages.qris.notes.index')
            ->with('status', 'Catatan QRIS berhasil dihapus.');
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

