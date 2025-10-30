@extends('layouts.app')

@section('content')
    <x-section
        title="Launching Dermaga Kayu dan Area Santai Baru"
        subtitle="Dermaga kayu berlapis anti slip dan kursi santai siap menyambut wisatawan jelang libur akhir tahun."
    >
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr]">
            <article class="space-y-6 text-slate-700">
                <figure class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                    <img
                        src="{{ Vite::asset('resources/images/blog/dermaga-launch.svg') }}"
                        alt="Dermaga kayu Waduk Manduk"
                        loading="lazy"
                        class="w-full object-cover"
                    >
                </figure>
                <x-blog.post-meta
                    date="12 Oktober 2025"
                    read-time="4 menit baca"
                    author="Tim Redaksi Manduk"
                />
                <p>
                    Waduk Manduk resmi memperkenalkan dermaga kayu baru berkapasitas 200 pengunjung. Struktur dermaga kini menggunakan
                    material ramah lingkungan dengan lapisan anti slip sehingga aman dipakai ketika hujan.
                </p>
                <p>
                    Area santai disertai kursi kayu ergonomis, penerangan hemat energi, dan titik foto baru menghadap lampion
                    terapung. Pengunjung dapat menikmati panorama matahari terbenam dengan latar belakang perahu wisata.
                </p>
                <h3 class="text-xl font-semibold text-slate-900">Fitur utama dermaga baru</h3>
                <ul class="list-disc space-y-2 pl-5">
                    <li>Jalur pedestrian ramah kursi roda dan stroller.</li>
                    <li>Railing pengaman dengan sensor pencahayaan otomatis.</li>
                    <li>Area charging station tersembunyi untuk perangkat gawai.</li>
                </ul>
                <p>
                    Fasilitas ini merupakan bagian dari program revitalisasi mandiri yang melibatkan BUMDes dan komunitas Manduk Creative.
                    Seluruh proses pengerjaan melibatkan tenaga kerja lokal dan menggunakan kayu bersertifikat.
                </p>
                <blockquote class="rounded-3xl border-l-4 border-blue-500 bg-blue-50 p-6 text-base font-medium text-blue-900">
                    &quot;Kami ingin menghadirkan dermaga yang nyaman kapan pun dikunjungi. Baik pagi maupun malam, pengunjung tetap merasa aman.&quot;
                    - Kepala Desa Manduk
                </blockquote>
                <p>
                    Dermaga baru ini juga menjadi titik awal program sunrise tour yang akan diluncurkan akhir tahun. Pengunjung
                    dapat melakukan reservasi paket perahu dan sarapan khas Manduk melalui kanal resmi setelah backend tersedia.
                </p>
            </article>
            <div class="space-y-6">
                <x-blog.share />
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Tag</h3>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <x-blog.tag-chip label="Fasilitas" />
                        <x-blog.tag-chip label="Infrastruktur" />
                        <x-blog.tag-chip label="Sunrise Tour" />
                    </div>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Artikel terkait</h3>
                    <ul class="mt-4 space-y-3 text-sm text-blue-600">
                        <li><a href="{{ route('blog.show', 'tips-menikmati-waduk-manduk-saat-musim-hujan') }}" class="hover:underline">Tips Menikmati Waduk Manduk Saat Musim Hujan</a></li>
                        <li><a href="{{ route('blog.show', 'cerita-pemandu-wisata-manduk') }}" class="hover:underline">Cerita Pemandu Wisata Manduk</a></li>
                        <li><a href="{{ route('blog.show', 'peresmian-studio-podcast-umkm') }}" class="hover:underline">Peresmian Studio Podcast UMKM</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </x-section>
@endsection
