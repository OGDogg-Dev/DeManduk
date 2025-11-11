@extends('layouts.admin', ['title' => 'Kelola Pengguna'])

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Manajemen Pengguna</h1>
            <p class="mt-2 text-sm text-slate-600">Tambah, ubah, atau nonaktifkan akun admin, kontributor, dan KPW.</p>
        </div>
        <a
            href="{{ route('admin.users.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
        >
            Tambah Pengguna
        </a>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Pengguna</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Peran</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Persetujuan</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Dibuat</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @php
                    $roleLabels = [
                        \App\Models\User::ROLE_ADMIN => ['label' => 'Administrator', 'class' => 'bg-indigo-50 text-indigo-700 border border-indigo-200'],
                        \App\Models\User::ROLE_CONTRIBUTOR => ['label' => 'Kontributor', 'class' => 'bg-blue-50 text-blue-700 border border-blue-200'],
                        \App\Models\User::ROLE_KPW => ['label' => 'KPW', 'class' => 'bg-amber-50 text-amber-700 border border-amber-200'],
                    ];
                @endphp
                @forelse ($users as $user)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-900">{{ $user->name }}</div>
                            <div class="text-xs text-slate-500">{{ $user->email }}</div>
                        </td>
                        <td class="px-5 py-4">
                            @php($role = $roleLabels[$user->role] ?? null)
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $role['class'] ?? 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                {{ $role['label'] ?? ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            @if ($user->requires_approval)
                                <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                    Menunggu Persetujuan
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    Aktif
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            {{ optional($user->created_at)->format('d M Y') ?? '-' }}
                        </td>
                        <td class="px-5 py-4 text-right">
                            <a
                                href="{{ route('admin.users.edit', $user) }}"
                                class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600"
                            >
                                Edit
                            </a>
                            <form
                                action="{{ route('admin.users.destroy', $user) }}"
                                method="POST"
                                class="ml-1 inline-block"
                                onsubmit="return confirm('Hapus pengguna ini?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 transition hover:border-rose-300"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-6 text-center text-sm text-slate-500">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endsection
