<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Models\SopDocument;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SopDocumentController extends Controller
{
    public function index(): View
    {
        $documents = SopDocument::query()
            ->orderBy('uploaded_at')
            ->orderBy('id')
            ->get();
        return view('admin.pages.sop.documents.index', compact('documents'));
    }

    public function create(): View
    {
        return view('admin.pages.sop.documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $size = $file->getSize();

        // Store the file in the 'documents' directory
        $filePath = $file->store('documents', 'public');

        SopDocument::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'original_name' => $originalName,
            'mime_type' => $mimeType,
            'file_size' => $size,
            'uploaded_at' => now(),
        ]);

        return redirect()->route('admin.pages.sop.documents.index')
            ->with('status', 'Dokumen SOP berhasil diunggah.');
    }

    public function edit(SopDocument $document): View
    {
        return view('admin.pages.sop.documents.edit', compact('document'));
    }

    public function update(Request $request, SopDocument $document): RedirectResponse
    {
        $rules = [
            'title' => 'required|string|max:255',
        ];

        // Add file validation if a new file is provided
        if ($request->hasFile('file')) {
            $rules['file'] = 'file|mimes:pdf|max:10240'; // max 10MB
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updates = [
            'title' => $request->title,
        ];

        // Handle file replacement if provided
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            $size = $file->getSize();

            // Store the new file in the 'documents' directory
            $newFilePath = $file->store('documents', 'public');

            // Delete the old file if it exists
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Update file-related attributes
            $updates['file_path'] = $newFilePath;
            $updates['original_name'] = $originalName;
            $updates['mime_type'] = $mimeType;
            $updates['file_size'] = $size;
        }

        $document->update($updates);

        return redirect()->route('admin.pages.sop.documents.index')
            ->with('status', 'Data dokumen SOP berhasil diperbarui.');
    }

    public function destroy(SopDocument $document): RedirectResponse
    {
        // Delete the actual file
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('admin.pages.sop.documents.index')
            ->with('status', 'Dokumen SOP berhasil dihapus.');
    }

    public function download(SopDocument $document)
    {
        $path = $this->resolveDocumentPath($document);

        return response()->download(
            $path,
            $document->original_name,
            [
                'Content-Type' => $document->mime_type ?: 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $document->original_name . '"',
            ]
        );
    }

    public function viewer(SopDocument $sopDocument)
    {
        return view('public.pdf.viewer', [
            'document' => $sopDocument,
            'fileUrl' => route('sop.pdf.viewer.inline', $sopDocument),
        ]);
    }

    public function viewInline(SopDocument $sopDocument)
    {
        $path = $this->resolveDocumentPath($sopDocument);
        $mimeType = $sopDocument->mime_type ?: 'application/pdf';

        return response()->stream(function () use ($path) {
            $stream = fopen($path, 'rb');

            if ($stream === false) {
                abort(404, 'File tidak dapat dibuka.');
            }

            while (! feof($stream)) {
                echo fread($stream, 8192);
            }

            fclose($stream);
        }, 200, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'private, max-age=3600',
            'Content-Length' => (string) filesize($path),
        ]);
    }

    protected function resolveDocumentPath(SopDocument $document): string
    {
        $relativePath = ltrim($document->file_path, '/');
        $path = storage_path('app/public/' . $relativePath);

        if (! is_file($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return $path;
    }
}
