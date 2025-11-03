@extends('layouts.app')

@section('content')
    <x-section
        title="Informasi QRIS Waduk Manduk"
        :subtitle="$subtitle ?? 'Nikmati transaksi non-tunai yang cepat dan aman di seluruh area Waduk Manduk menggunakan satu kode QR resmi.'"
    >
        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="space-y-6">
                @if ($primaryAlert['title'] ?? false)
                    <x-alert :variant="$primaryAlert['variant'] ?? 'info'" :title="$primaryAlert['title']">
                        {{ $primaryAlert['body'] ?? '' }}
                    </x-alert>
                @endif

                <x-qris.steps
                    :steps="$steps->map(fn($step) => [
                        'title' => $step->title,
                        'description' => $step->description,
                    ])->toArray()"
                />

                @if ($notes->isNotEmpty())
                    <div class="glass-card rounded-3xl p-6 shadow-2xl">
                        <h3 class="text-base font-semibold text-white">Catatan transaksi</h3>
                        <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-slate-200">
                            @foreach ($notes as $note)
                                <li>{{ $note->content }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="space-y-6">
                @if ($poster['download'])
                    <x-qris.download-poster
                        :image="$poster['download']"
                        :download="$poster['download']"
                        :format="$poster['format'] ?? 'Unduh'"
                        :formats="$poster['formats'] ?? 'Format tersedia segera'"
                    />
                @endif
            </div>
        </div>
    </x-section>

    @if ($faqs->isNotEmpty())
        <x-section variant="muted" title="Pertanyaan umum seputar QRIS">
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($faqs as $faq)
                    <x-card :title="$faq->title">
                        @if ($faq->icon)
                            <x-slot:icon>{{ $faq->icon }}</x-slot:icon>
                        @endif
                        <p class="text-sm text-slate-200">
                            {{ $faq->body }}
                        </p>
                    </x-card>
                @endforeach
            </div>
        </x-section>
    @endif

    @if ($bottomAlert['title'] ?? false)
        <x-section title="Butuh bantuan lebih lanjut?">
            <x-alert :variant="$bottomAlert['variant'] ?? 'warning'" :title="$bottomAlert['title']">
                {{ $bottomAlert['body'] ?? '' }}
            </x-alert>
        </x-section>
    @endif
@endsection
