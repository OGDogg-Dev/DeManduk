<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait StoresMedia
{
    protected function storeUploadedFile(Request $request, string $field, string $directory, ?string $existing = null): ?string
    {
        if (! $request->hasFile($field)) {
            return $existing;
        }

        $file = $request->file($field);

        if ($existing) {
            $this->deleteStoredFile($existing);
        }

        return $file->store($directory, 'public');
    }

    protected function deleteStoredFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
