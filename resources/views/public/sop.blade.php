@extends('layouts.app')

@section('content')
    <x-section
        title="Standar Operasional Prosedur D'Manduk"
        :subtitle="$subtitle ?? 'Dokumen ringkas ini menjadi acuan utama bagi pengunjung, pelaku UMKM, dan petugas dalam menjaga kualitas layanan Waduk Manduk.'"
    >
        <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="glass-card rounded-3xl p-8 shadow-2xl space-y-5 text-slate-200">
                @forelse ($introParagraphs as $paragraph)
                    <p>{{ $paragraph }}</p>
                @empty
                    <p>
                        SOP D'Manduk disusun untuk memastikan setiap aktivitas wisata berjalan aman, tertib, dan inklusif.
                        Ringkasan berikut membantu Anda memahami alur utama pelayanan ketika berkunjung.
                    </p>
                @endforelse

                @if ($infoAlert['title'] ?? false)
                    <x-alert :variant="$infoAlert['variant'] ?? 'info'" :title="$infoAlert['title']">
                        {{ $infoAlert['body'] ?? '' }}
                    </x-alert>
                @endif
            </div>
            <div class="glass-card rounded-3xl p-8 shadow-2xl">
                <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">Tujuan utama</h3>
                <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-relaxed text-slate-200">
                    @forelse ($objectives as $objective)
                        <li>{{ $objective->content }}</li>
                    @empty
                        <li>Tujuan SOP akan diperbarui oleh pengelola.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </x-section>

    <x-section
        variant="muted"
        title="Alur pelayanan inti"
        subtitle="Ikuti langkah-langkah berikut agar pengalaman berwisata tetap nyaman dan sesuai prosedur."
    >
        <div class="grid gap-6 lg:grid-cols-2">
            @forelse ($steps as $index => $step)
                <article class="glass-card rounded-3xl p-6 shadow-2xl">
                    <h3 class="text-base font-semibold text-white">{{ $loop->iteration }}. {{ $step->title }}</h3>
                    <ol class="mt-3 space-y-3 text-sm leading-relaxed text-slate-200">
                        @foreach ($step->items ?? [] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ol>
                </article>
            @empty
                <p class="text-sm text-slate-300">Langkah SOP akan diinformasikan segera.</p>
            @endforelse
        </div>
    </x-section>

    <x-section title="Koordinasi instansi pendukung">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($partners as $partner)
                <div class="glass-card rounded-2xl p-5 shadow-2xl">
                    <h4 class="text-sm font-semibold text-white">{{ $partner->title }}</h4>
                    <p class="mt-2 text-sm text-slate-200">{{ $partner->description }}</p>
                </div>
            @empty
                <p class="text-sm text-slate-300">Data instansi pendukung belum tersedia.</p>
            @endforelse
        </div>
        @if ($bottomAlert['title'] ?? false)
            <x-alert :variant="$bottomAlert['variant'] ?? 'success'" :title="$bottomAlert['title']">
                {{ $bottomAlert['body'] ?? '' }}
            </x-alert>
        @endif
    </x-section>
@endsection
