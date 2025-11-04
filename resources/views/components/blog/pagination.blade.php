@props([
    'current' => 1,
    'total'   => 1,
    'param'   => 'page', // nama query param, default "page"
    'window'  => 2,      // jumlah halaman di kiri/kanan current yang ditampilkan
])

@php
    $page   = max(1, (int) $current);
    $total  = max(1, (int) $total);
    $window = max(0, (int) $window);

    // Builder URL: pertahankan semua query lain
    $makeUrl = function (int $p) use ($param) {
        return request()->fullUrlWithQuery([$param => $p]);
    };

    $links = [];

    $push = function ($label, $p = null, $active = false) use (&$links, $makeUrl) {
        $links[] = [
            'label'  => $label,
            'href'   => $p ? $makeUrl($p) : null, // null => jadi ellipsis/non-clickable
            'active' => $active,
        ];
    };

    if ($total <= 7) {
        // Tampilkan semua halaman bila total kecil
        for ($i = 1; $i <= $total; $i++) {
            $push($i, $i, $i === $page);
        }
    } else {
        // Selalu tampilkan halaman pertama
        $push(1, 1, $page === 1);

        $start = max(2, $page - $window);
        $end   = min($total - 1, $page + $window);

        if ($start > 2) {
            $push('…'); // ellipsis
        }

        for ($i = $start; $i <= $end; $i++) {
            $push($i, $i, $i === $page);
        }

        if ($end < $total - 1) {
            $push('…'); // ellipsis
        }

        // Selalu tampilkan halaman terakhir
        $push($total, $total, $page === $total);
    }

    $prev = $page > 1     ? ['label' => 'Sebelumnya', 'href' => $makeUrl($page - 1)] : null;
    $next = $page < $total? ['label' => 'Berikutnya', 'href' => $makeUrl($page + 1)]  : null;
@endphp

<x-pagination :links="$links" :prev="$prev" :next="$next" />
