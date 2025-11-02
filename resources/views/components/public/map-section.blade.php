@props([
    'mapsUrl' => 'https://maps.google.com/maps?q=Waduk%20Manduk&t=&z=15&ie=UTF8&iwloc=&output=embed',
    'title' => 'Peta Interaktif',
    'subtitle' => 'Gunakan peta di bawah untuk menemukan titik parkir, loket tiket, area kuliner, dan jalur pejalan kaki.',
    'linkLabel' => 'Buka di Google Maps',
    'directionsUrl' => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
])

@php
    $mapsUrl = $mapsUrl ?: 'https://maps.google.com/maps?q=Waduk%20Manduk&t=&z=15&ie=UTF8&iwloc=&output=embed';
    $linkLabel = $linkLabel ?: 'Buka di Google Maps';
    $directionsUrl = $directionsUrl ?: 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7';
@endphp

<x-section
    id="map"
    :title="$title"
    :subtitle="$subtitle"
>
    @include('partials._map', [
        'mapsUrl' => $mapsUrl,
        'title' => $title,
        'linkLabel' => $linkLabel,
        'directionsUrl' => $directionsUrl,
    ])
</x-section>
