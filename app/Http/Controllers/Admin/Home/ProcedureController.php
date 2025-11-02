<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeProcedure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProcedureController extends Controller
{
    public function index(): View
    {
        $procedures = HomeProcedure::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.home.procedures.index', compact('procedures'));
    }

    public function create(): View
    {
        return view('admin.home.procedures.create');
    }

    public function store(Request $request): RedirectResponse
    {
        HomeProcedure::create($this->validatedData($request));

        return redirect()->route('admin.home.procedures.index')
            ->with('status', 'Highlight SOP berhasil ditambahkan.');
    }

    public function edit(HomeProcedure $procedure): View
    {
        return view('admin.home.procedures.edit', compact('procedure'));
    }

    public function update(Request $request, HomeProcedure $procedure): RedirectResponse
    {
        $procedure->update($this->validatedData($request));

        return redirect()->route('admin.home.procedures.index')
            ->with('status', 'Highlight SOP berhasil diperbarui.');
    }

    public function destroy(HomeProcedure $procedure): RedirectResponse
    {
        $procedure->delete();

        return redirect()->route('admin.home.procedures.index')
            ->with('status', 'Highlight SOP berhasil dihapus.');
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
