<footer class="border-t border-slate-200 bg-white">
    <div class="mx-auto flex max-w-6xl flex-col gap-16 px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 md:grid-cols-4">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 font-semibold text-white">
                        WM
                    </span>
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Portal Resmi</p>
                        <p class="text-xl font-bold text-slate-900">Waduk Manduk</p>
                    </div>
                </div>
                <p class="mt-6 max-w-xl text-sm text-slate-600">
                    Destinasi wisata alam di Lamongan dengan fasilitas keluarga, kuliner lokal, dan panorama waduk yang memukau.
                    Situs ini menjadi sumber informasi terkurasi tentang agenda, berita, dan layanan Waduk Manduk.
                </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Kontak Resmi</h3>
                <ul class="mt-4 space-y-2 text-sm text-slate-600">
                    <li>
                        <span class="font-semibold text-slate-800">Alamat:</span>
                        Desa Manduk, Kecamatan Ngargoyoso, Kabupaten Karanganyar
                    </li>
                    <li>
                        <span class="font-semibold text-slate-800">Telepon:</span>
                        <a href="tel:+62312999999" class="hover:text-blue-600">+62 312 999 999</a>
                    </li>
                    <li>
                        <span class="font-semibold text-slate-800">Email:</span>
                        <a href="mailto:halo@wadukmanduk.id" class="hover:text-blue-600">halo@wadukmanduk.id</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Navigasi</h3>
                <ul class="mt-4 space-y-2 text-sm text-slate-600">
                    <li><a href="{{ route('fasilitas.harga') }}" class="hover:text-blue-600">Fasilitas & Harga</a></li>
                    <li><a href="{{ route('event.index') }}" class="hover:text-blue-600">Event & Agenda</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-blue-600">Berita & Blog</a></li>
                    <li><a href="{{ route('qris') }}" class="hover:text-blue-600">Informasi QRIS</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-blue-600">Kontak & Form Masukan</a></li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col gap-4 border-t border-slate-200 pt-6 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-slate-500">
                &copy; {{ now()->year }} Pemerintah Desa Manduk. Semua hak cipta dilindungi.
            </p>
            <div class="flex items-center gap-4 text-xs font-semibold text-slate-600">
                <a href="{{ route('faq') }}" class="hover:text-blue-600">FAQ</a>
                <a href="{{ route('kontak') }}" class="hover:text-blue-600">Hubungi Kami</a>
                <a href="{{ route('qris') }}" class="hover:text-blue-600">Kebijakan Pembayaran</a>
            </div>
        </div>
    </div>
</footer>
