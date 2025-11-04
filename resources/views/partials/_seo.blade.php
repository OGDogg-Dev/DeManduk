@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Stringable;

    // ====== Brand / situs (aman tanpa $post) ======
    $siteName   = isset($siteTitle) && is_string($siteTitle) && $siteTitle !== '' ? $siteTitle : "D'Manduk";
    $baseTitle  = 'Portal Resmi ' . $siteName;

    // ====== Judul ======
    $titleValue = (isset($title) && is_string($title) && $title !== '') ? $title : $baseTitle;

    // Stringable->append agar tidak error ketemu null, hindari $post sama sekali
    $seoTitle = (string) Str::of($titleValue)->when(
        filled($titleValue) && ! Str::contains($titleValue, $siteName),
        fn (Stringable $s) => $s->append(' | ' . $baseTitle)
    );

    // ====== Deskripsi ======
    $seoDescription = (isset($description) && is_string($description) && $description !== '')
        ? $description
        : "Temukan informasi lengkap D'Manduk: fasilitas, harga tiket, agenda event, berita terbaru, SOP, dan kontak resmi.";

    // ====== Gambar (URL absolut) ======
    // Tidak menyentuh $post sama sekali
    $rawImage = (isset($image) && is_string($image) && $image !== '')
        ? $image
        : 'resources/images/seo-cover.svg';

    $seoImage = Str::startsWith($rawImage, ['http://', 'https://'])
        ? $rawImage
        : (Str::startsWith($rawImage, 'resources/')
            ? Vite::asset($rawImage)
            : asset($rawImage));

    $seoUrl = url()->current();

    // Opsi opsional yang boleh dipass dari view mana pun (tidak wajib)
    $ogType       = (isset($ogType) && is_string($ogType)) ? $ogType : 'website';
    $publishedAt  = isset($publishedAt) ? (string) $publishedAt : null; // ISO8601 jika ada
    $modifiedAt   = isset($modifiedAt)  ? (string) $modifiedAt  : null; // ISO8601 jika ada
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<link rel="canonical" href="{{ $seoUrl }}">

<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoUrl }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:locale" content="id_ID">
@if ($publishedAt)<meta property="article:published_time" content="{{ $publishedAt }}">@endif
@if ($modifiedAt)<meta property="article:modified_time" content="{{ $modifiedAt }}">@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">

@push('head')
    @php
        // Schema.org generik — TouristAttraction (aman dipakai di semua halaman publik)
        $seoSchema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'TouristAttraction',
            'name'        => $siteName,
            'url'         => $seoUrl,
            'description' => $seoDescription,
            'image'       => [$seoImage],
            'address'     => [
                '@type'          => 'PostalAddress',
                'addressCountry' => 'ID',
                'streetAddress'  => 'Dusun Manduk RT. 4 / RW. 5, Desa Jatirejo, Ngargoyoso, Karanganyar',
            ],
        ];
    @endphp
    <script type="application/ld+json">
        {!! json_encode($seoSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush
