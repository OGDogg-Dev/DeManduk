@php
    $currentUser = $user ?? null;
    $isEdit = (bool) $currentUser;
    $roleOptions = [
        \App\Models\User::ROLE_ADMIN => 'Administrator',
        \App\Models\User::ROLE_CONTRIBUTOR => 'Kontributor',
        \App\Models\User::ROLE_KPW => 'KPW',
    ];
@endphp

<div class="grid gap-6 md:grid-cols-2">
    <div class="space-y-1">
        <label for="name" class="text-sm font-semibold text-slate-700">Nama lengkap</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $currentUser->name ?? '') }}"
            required
            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200"
            placeholder="Nama pengguna"
        >
        @error('name')
            <p class="text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="space-y-1">
        <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $currentUser->email ?? '') }}"
            required
            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200"
            placeholder="nama@wadukmanduk.id"
        >
        @error('email')
            <p class="text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="grid gap-6 md:grid-cols-2">
    <div class="space-y-1">
        <label for="role" class="text-sm font-semibold text-slate-700">Peran</label>
        <select
            id="role"
            name="role"
            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200"
            required
        >
            @foreach ($roleOptions as $value => $label)
                <option value="{{ $value }}" @selected(old('role', $currentUser->role ?? \App\Models\User::ROLE_CONTRIBUTOR) === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('role')
            <p class="text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="space-y-1">
        <label class="text-sm font-semibold text-slate-700">Persetujuan manual</label>
        <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
            <span>Wajib disetujui sebelum aktif</span>
            <input
                type="checkbox"
                name="requires_approval"
                value="1"
                class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                @checked(old('requires_approval', $currentUser->requires_approval ?? false))
            >
        </label>
        @error('requires_approval')
            <p class="text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="space-y-1">
    <label for="password" class="text-sm font-semibold text-slate-700">Kata sandi {!! $isEdit ? '<span class="font-normal text-slate-500">(kosongkan jika tidak diganti)</span>' : '' !!}</label>
    <input
        type="password"
        id="password"
        name="password"
        @if (! $isEdit) required @endif
        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200"
        placeholder="Minimal 8 karakter"
    >
    @error('password')
        <p class="text-xs text-rose-600">{{ $message }}</p>
    @enderror
</div>
