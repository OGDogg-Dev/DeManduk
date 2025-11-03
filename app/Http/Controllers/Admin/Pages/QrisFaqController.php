<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\QrisFaq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QrisFaqController extends Controller
{
    public function index(): View
    {
        $faqs = QrisFaq::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.qris.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.pages.qris.faqs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        QrisFaq::create($data);

        return redirect()
            ->route('admin.pages.qris.faqs.index')
            ->with('status', 'FAQ QRIS berhasil ditambahkan.');
    }

    public function edit(QrisFaq $faq): View
    {
        return view('admin.pages.qris.faqs.edit', compact('faq'));
    }

    public function update(Request $request, QrisFaq $faq): RedirectResponse
    {
        $data = $this->validatedData($request);
        $faq->update($data);

        return redirect()
            ->route('admin.pages.qris.faqs.index')
            ->with('status', 'FAQ QRIS berhasil diperbarui.');
    }

    public function destroy(QrisFaq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()
            ->route('admin.pages.qris.faqs.index')
            ->with('status', 'FAQ QRIS berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'icon' => ['nullable', 'string', 'max:10'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}

