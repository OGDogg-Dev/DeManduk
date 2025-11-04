@extends('layouts.app', [
    'title' => 'Kontak — Waduk Manduk',
    'description' => 'Sampaikan pertanyaan, saran, keluhan, atau rencana kerja sama. Tim D\'Manduk merespons maksimal 2 hari kerja.',
])

@section('content')
@php
    use Illuminate\Support\Facades\Route;

    // Action form: pakai route('contact.submit') kalau ada, fallback ke URL saat ini (POST ke halaman yang sama)
    $formAction = Route::has('contact.submit') ? route('contact.submit') : url()->current();
    $todayMin   = now('Asia/Jakarta')->toDateString();

    // Link WhatsApp cepat (prefill)
    $waNumber  = isset($phone) ? preg_replace('/\D+/', '', $phone) : null; // pastikan angka saja
@endphp

    <x-section class="pb-16">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-semibold text-[var(--color-ink)] mb-4">Hubungi Kami</h1>
            <p class="text-lg text-[var(--color-muted)] max-w-2xl mx-auto">
                {{$subtitle ?? 'Sampaikan pertanyaan, saran, atau kebutuhan kerja sama Anda. Tim kami akan merespons maksimal dalam dua hari kerja.'}}
            </p>
        </div>

        <div class="grid gap-4">
            {{-- Flash sukses & error global --}}
            <div class="space-y-3">
                @if (session('success') || session('status') || session('contact_sent'))
                    <x-alert variant="success" title="Terima kasih!">
                        {{ session('success') ?? session('status') ?? session('contact_sent') }}
                    </x-alert>
                @endif

                @if ($errors->any())
                    <x-alert variant="danger" title="Periksa kembali isian Anda">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </x-alert>
                @endif
            </div>

            <div class="grid gap-4 lg:grid-cols-[2fr_1fr]">
                {{-- FORM KONTAK --}}
                <div class="space-y-4 rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)] p-5 shadow-sm">
                    <h2 class="text-lg font-semibold text-[var(--color-ink)] mb-4">Kirim Pesan</h2>
                    
                    <form
                        action="{{ $formAction }}"
                        method="POST"
                        class=""
                        data-contact
                    >
                        @csrf

                        {{-- Honeypot anti-spam --}}
                        <div class="hidden">
                            <label>Jangan diisi</label>
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                            <input type="text" name="hp_time" value="{{ time() }}">
                        </div>

                        <div class="space-y-6">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="contact-name" class="block text-sm font-semibold text-[var(--color-ink)] mb-2">
                                        Nama lengkap <span class="text-[var(--color-primary)]">*</span>
                                    </label>
                                    <input
                                        id="contact-name"
                                        name="name"
                                        type="text"
                                        required
                                        placeholder="Nama Anda"
                                        value="{{ old('name') }}"
                                        class="w-full rounded-lg border {{ $errors->has('name') ? 'border-[var(--color-primary)] bg-[var(--color-surface)]' : 'border-[var(--color-border)] bg-[var(--color-surface)]' }} px-4 py-3 text-sm text-[var(--color-ink)] placeholder:text-[var(--color-muted)] focus:border-[var(--color-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/20"
                                        autocomplete="name"
                                    >
                                    @error('name')
                                        <p class="mt-1 text-xs text-[var(--color-primary)]">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="contact-email" class="block text-sm font-semibold text-[var(--color-ink)] mb-2">
                                        Email <span class="text-[var(--color-primary)]">*</span>
                                    </label>
                                    <input
                                        id="contact-email"
                                        name="email"
                                        type="email"
                                        required
                                        placeholder="nama@domain.com"
                                        value="{{ old('email') }}"
                                        class="w-full rounded-lg border {{ $errors->has('email') ? 'border-[var(--color-primary)] bg-[var(--color-surface)]' : 'border-[var(--color-border)] bg-[var(--color-surface)]' }} px-4 py-3 text-sm text-[var(--color-ink)] placeholder:text-[var(--color-muted)] focus:border-[var(--color-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/20"
                                        autocomplete="email"
                                    >
                                    @error('email')
                                        <p class="mt-1 text-xs text-[var(--color-primary)]">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="contact-topic" class="block text-sm font-semibold text-[var(--color-ink)] mb-2">
                                    Topik Pesan
                                </label>
                                <select
                                    id="contact-topic"
                                    name="topic"
                                    class="w-full rounded-lg border {{ $errors->has('topic') ? 'border-[var(--color-primary)] bg-[var(--color-surface)]' : 'border-[var(--color-border)] bg-[var(--color-surface)]' }} px-4 py-3 text-sm text-[var(--color-ink)] focus:border-[var(--color-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/20"
                                >
                                    @php
                                        $topics = ['Informasi umum', 'Kerja sama event', 'Keluhan atau pengaduan', 'Kemitraan UMKM'];
                                        $topicOld = old('topic');
                                    @endphp
                                    @foreach ($topics as $t)
                                        <option value="{{ $t }}" {{ $topicOld === $t ? 'selected' : '' }}>{{ $t }}</option>
                                    @endforeach
                                </select>
                                @error('topic')
                                    <p class="mt-1 text-xs text-[var(--color-primary)]">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact-message" class="block text-sm font-semibold text-[var(--color-ink)] mb-2">
                                    Pesan Anda <span class="text-[var(--color-primary)]">*</span>
                                </label>
                                <textarea
                                    id="contact-message"
                                    name="message"
                                    rows="6"
                                    required
                                    class="w-full rounded-lg border {{ $errors->has('message') ? 'border-[var(--color-primary)] bg-[var(--color-surface)]' : 'border-[var(--color-border)] bg-[var(--color-surface)]' }} px-4 py-3 text-sm text-[var(--color-ink)] placeholder:text-[var(--color-muted)] focus:border-[var(--color-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/20"
                                    placeholder="Jelaskan pertanyaan, saran, atau kebutuhan Anda secara detail..."
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-xs text-[var(--color-primary)]">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="contact-phone" class="block text-sm font-semibold text-[var(--color-ink)] mb-2">
                                        Nomor WhatsApp (opsional)
                                    </label>
                                    <input
                                        id="contact-phone"
                                        name="phone"
                                        type="tel"
                                        inputmode="tel"
                                        placeholder="+62 812 3456 7890"
                                        value="{{ old('phone') }}"
                                        class="w-full rounded-lg border {{ $errors->has('phone') ? 'border-[var(--color-primary)] bg-[var(--color-surface)]' : 'border-[var(--color-border)] bg-[var(--color-surface)]' }} px-4 py-3 text-sm text-[var(--color-ink)] placeholder:text-[var(--color-muted)] focus:border-[var(--color-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/20"
                                        autocomplete="tel"
                                    >
                                    @error('phone')
                                        <p class="mt-1 text-xs text-[var(--color-primary)]">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="contact-date" class="block text-sm font-semibold text-[var(--color-ink)] mb-2">
                                        Tanggal kunjungan (opsional)
                                    </label>
                                    <input
                                        id="contact-date"
                                        name="visit_date"
                                        type="date"
                                        min="{{ $todayMin }}"
                                        value="{{ old('visit_date') }}"
                                        class="w-full rounded-lg border {{ $errors->has('visit_date') ? 'border-[var(--color-primary)] bg-[var(--color-surface)]' : 'border-[var(--color-border)] bg-[var(--color-surface)]' }} px-4 py-3 text-sm text-[var(--color-ink)] focus:border-[var(--color-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/20"
                                    >
                                    @error('visit_date')
                                        <p class="mt-1 text-xs text-[var(--color-primary)]">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <p class="text-xs text-[var(--color-muted)] max-w-xs">
                                    Data Anda hanya digunakan untuk menanggapi permintaan ini dan tidak dibagikan ke pihak ketiga.
                                </p>
                                <div class="flex flex-wrap gap-3">
                                    @if ($waNumber)
                                        @php
                                            $waText = rawurlencode("Halo D'Manduk, saya ingin menanyakan: ");
                                        @endphp
                                        <a
                                            href="https://wa.me/{{ $waNumber }}?text={{ $waText }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center gap-2 rounded-lg border border-[var(--color-border)] px-4 py-2.5 text-sm font-medium text-[var(--color-ink)] transition hover:bg-[var(--color-elev)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/30"
                                        >
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.296-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.485 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.158 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.892-11.893A11.825 11.825 0 0020.465 3.488"/>
                                            </svg>
                                            WhatsApp
                                        </a>
                                    @endif
                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-2 rounded-lg bg-[var(--color-primary)] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[var(--color-primary-600)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/50"
                                        data-submit
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                        Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- live region untuk feedback AJAX (opsional) --}}
                        <p class="sr-only" role="status" aria-live="polite" data-live></p>
                    </form>
                </div>

                {{-- PANEL INFORMASI --}}
                <div class="space-y-6 rounded-2xl border border-[var(--color-border)] bg-[var(--color-surface)] p-6 shadow-sm">
                    <div class="flex items-center gap-3 pb-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-[var(--color-ink)]">Kontak Darurat</h3>
                            <p class="text-sm text-[var(--color-muted)]">Hubungi kami jika Anda membutuhkan bantuan darurat</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6 text-sm text-[var(--color-ink)]">
                        <div class="border-t border-[var(--color-border)] pt-4">
                            <h4 class="font-semibold text-[var(--color-ink)] mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Alamat Operasional
                            </h4>
                            <p class="text-[var(--color-muted)] pl-6">{{ $address ?? '-' }}</p>
                        </div>
                        
                        <div class="border-t border-[var(--color-border)] pt-4">
                            <h4 class="font-semibold text-[var(--color-ink)] mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                                </svg>
                                Instansi Pendukung
                            </h4>
                            <div class="space-y-4">
                                @forelse ($supports as $support)
                                    <div class="bg-[var(--color-elev)] rounded-xl p-4">
                                        <div class="font-semibold text-[var(--color-ink)] flex items-center gap-2">
                                            <svg class="w-4 h-4 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            {{ $support->title }}
                                        </div>
                                        <div class="text-sm text-[var(--color-muted)] mt-1">{{ $support->description }}</div>
                                        
                                        @if ($support->phone)
                                            <div class="mt-2 flex items-center gap-2">
                                                <svg class="w-4 h-4 text-[var(--color-primary)] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                <a href="tel:{{ $support->phone }}" class="text-[var(--color-primary)] hover:underline text-sm">
                                                    {{ $support->phone }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-[var(--color-muted)] text-sm pl-6">Informasi instansi akan diperbarui segera.</div>
                                @endforelse
                            </div>
                        </div>
                        
                        <div class="border-t border-[var(--color-border)] pt-4">
                            <h4 class="font-semibold text-[var(--color-ink)] mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Kontak Umum
                            </h4>
                            <div class="grid grid-cols-1 gap-3 pl-6">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[var(--color-primary)] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span class="text-sm">
                                        @if ($phone)
                                            <a href="tel:{{ $phone }}" class="text-[var(--color-primary)] hover:underline">{{ $phone }}</a>
                                        @else
                                            <span class="text-[var(--color-muted)]">-</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[var(--color-primary)] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-sm">
                                        @if ($email)
                                            <a href="mailto:{{ $email }}" class="text-[var(--color-primary)] hover:underline">{{ $email }}</a>
                                        @else
                                            <span class="text-[var(--color-muted)]">-</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @forelse ($alerts as $alert)
                        <div class="pt-4">
                            <x-alert :variant="$alert->variant" :title="$alert->title">
                                {{ $alert->body }}
                            </x-alert>
                        </div>
                    @empty
                        <div class="pt-4">
                            <x-alert variant="info" title="Informasi akan diperbarui">
                                Tim kami sedang menyiapkan pembaruan pesan penting untuk pengunjung.
                            </x-alert>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </x-section>
@endsection

@push('scripts')
<script>
(() => {
  const form = document.querySelector('[data-contact]');
  if (!form) return;

  const btn = form.querySelector('[data-submit]');
  const live = form.querySelector('[data-live]');

  form.addEventListener('submit', () => {
    if (!btn) return;
    btn.dataset._label = btn.textContent;
    btn.textContent = 'Mengirim...';
    btn.setAttribute('disabled', 'true');
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    live && (live.textContent = 'Mengirim formulir...');
  });

  // Re-enable (kalau halaman tidak redirect/validasi server side)
  window.addEventListener('pageshow', () => {
    if (!btn) return;
    btn.removeAttribute('disabled');
    btn.classList.remove('opacity-75', 'cursor-not-allowed');
    if (btn.dataset._label) btn.textContent = btn.dataset._label;
  }, { once: true });
})();
</script>
@endpush
