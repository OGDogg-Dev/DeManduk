<?php

namespace Database\Seeders;

use App\Models\SopDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SopDocumentsSeeder extends Seeder
{
    public function run(): void
    {
        // Create a sample directory if it doesn't exist and add a placeholder
        if (!Storage::disk('public')->exists('documents')) {
            Storage::disk('public')->makeDirectory('documents');
        }
        
        // Create a placeholder PDF file if needed for testing
        $samplePdfPath = storage_path('app/public/documents/sample-sop.pdf');
        if (!file_exists($samplePdfPath)) {
            // Create a simple placeholder PDF file
            $pdfContent = "%PDF-1.4\n1 0 obj\n<<\n/Title (Sample SOP Document)\n/Author (Waduk Manduk)\n>>\nendobj\ntrailer\n<<\n/Root 1 0 R\n>>\n%%EOF";
            file_put_contents($samplePdfPath, $pdfContent);
        }

        SopDocument::create([
            'title' => 'SOP Standar Waduk Manduk',
            'file_path' => 'documents/sample-sop.pdf',
            'original_name' => 'sop-standar-waduk-manduk.pdf',
            'mime_type' => 'application/pdf',
            'file_size' => filesize($samplePdfPath),
            'uploaded_at' => now(),
        ]);
    }
}