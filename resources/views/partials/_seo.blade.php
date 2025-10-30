@php
    use Illuminate\Support\Str;

    $baseTitle = 'Portal Resmi Waduk Manduk';
    $siteName = 'Waduk Manduk';

    // Ensure title is a string
    $titleValue = is_string($title) ? $title : $baseTitle;

    $seoTitle = Str::of($titleValue)->when(
        filled($titleValue) && !Str::contains($titleValue, $siteName),
        fn ($value) => $value . ' | ' . $baseTitle,
    )->value();

    // Ensure description is a string
    $seoDescription = is_string($description)
        ? $description
        : 'Temukan informasi lengkap Waduk Manduk: fasilitas, harga tiket, agenda event, berita terbaru, FAQ, dan kontak resmi.';

    $seoImage = is_string($image) ? $image : Vite::asset('resources/images/seo-cover.svg');
    $seoUrl = url()->current();
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoUrl }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:locale" content="id_ID">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">
<link rel="canonical" href="{{ $seoUrl }}">

@push('head')
    @php
        $seoSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'TouristAttraction',
            'name' => $siteName,
            'url' => $seoUrl,
            'description' => $seoDescription,
            'image' => [$seoImage],
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'ID',
            ],
        ];
    @endphp
    <script type="application/ld+json">
        {!! json_encode($seoSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush
