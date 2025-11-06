<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document->title }} - Pratinjau PDF</title>
    <style>
        :root {
            color-scheme: light;
        }

        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }

        .header {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1.25rem;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
            z-index: 10;
        }

        .title-group {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            color: #1e293b;
        }

        .meta {
            font-size: 0.85rem;
            color: #64748b;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            border-radius: 999px;
            border: 1px solid #cbd5e1;
            background: white;
            color: #475569;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn svg {
            width: 16px;
            height: 16px;
        }

        .btn:hover {
            border-color: #94a3b8;
            background: #f1f5f9;
        }

        .btn-primary {
            border-color: #2563eb;
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .viewer {
            flex: 1;
            min-height: 0;
            position: relative;
            background: #1e293b;
            display: flex;
            flex-direction: column;
        }

        .viewer iframe,
        .viewer object,
        .viewer embed {
            flex: 1;
            border: none;
            width: 100%;
            background: #475569;
        }

        .fallback {
            position: absolute;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            background: rgba(15, 23, 42, 0.88);
            color: #e2e8f0;
        }

        .fallback.active {
            display: flex;
        }

        .fallback a {
            color: #38bdf8;
            text-decoration: none;
        }

        .fallback a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="title-group">
            <h1 class="title">{{ $document->title }}</h1>
            <div class="meta">
                {{ $document->original_name }} •
                {{ number_format(($document->file_size ?? 0) / 1024, 1) }} KB
            </div>
        </div>
        <div class="actions">
            <a href="{{ route('sop.download', $document) }}" class="btn btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Unduh
            </a>
            <button type="button" class="btn" onclick="window.print()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V4h12v5M6 18h12m-9 0v-3h6v3" />
                </svg>
                Cetak
            </button>
            <button type="button" class="btn" onclick="window.close()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Tutup
            </button>
        </div>
    </header>

    <main class="viewer">
        <iframe
            src="{{ $fileUrl }}"
            title="Pratinjau {{ $document->title }}"
            onload="document.getElementById('viewer-fallback').classList.remove('active');"
        ></iframe>

        <div id="viewer-fallback" class="fallback active" role="alert">
            <div>
                <h2 style="margin-bottom: 0.75rem;">Sedang membuka dokumen…</h2>
                <p>
                    Jika pratinjau tidak muncul, Anda bisa
                    <a href="{{ route('sop.download', $document) }}">mengunduh dokumen</a>
                    kemudian membukanya secara manual.
                </p>
            </div>
        </div>
    </main>
</body>
</html>
