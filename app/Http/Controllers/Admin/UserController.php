<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->orderBy('role')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'roles' => $this->roleOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $user = new User();
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
            'requires_approval' => $data['requires_approval'],
        ]);
        $user->email_verified_at = now();
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $this->roleOptions(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $this->validatedData($request, $user);

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'requires_approval' => $data['requires_approval'],
        ]);

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (Auth::id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Pengguna berhasil dihapus.');
    }

    private function validatedData(Request $request, ?User $user = null): array
    {
        $roles = $this->roleOptions();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user?->id),
            ],
            'role' => ['required', Rule::in(array_keys($roles))],
            'requires_approval' => ['nullable', 'boolean'],
        ];

        $passwordRule = $user ? ['nullable', 'string', 'min:8'] : ['required', 'string', 'min:8'];
        $rules['password'] = $passwordRule;

        $data = $request->validate($rules);

        $data['requires_approval'] = (bool) ($data['requires_approval'] ?? false);

        return $data;
    }

    /**
     * @return array<string, string>
     */
    private function roleOptions(): array
    {
        return [
            User::ROLE_ADMIN => 'Administrator',
            User::ROLE_CONTRIBUTOR => 'Kontributor',
            User::ROLE_KPW => 'KPW',
        ];
    }
}
