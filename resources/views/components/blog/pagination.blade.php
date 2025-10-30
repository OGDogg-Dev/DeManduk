@props([
    'current' => 1,
    'total' => 1,
])

@php
    $links = [];
    for ($page = 1; $page <= $total; $page++) {
        $links[] = [
            'label' => $page,
            'href' => '#',
            'active' => $page === $current,
        ];
    }
@endphp

<x-pagination
    :links="$links"
    :prev="($current > 1) ? ['label' => 'Sebelumnya', 'href' => '#'] : null"
    :next="($current < $total) ? ['label' => 'Berikutnya', 'href' => '#'] : null"
/>
