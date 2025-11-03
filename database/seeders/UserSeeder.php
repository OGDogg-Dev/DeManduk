<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            [
                'name' => "Administrator D'Manduk",
                'email' => 'admin@dmanduk.test',
                'password' => 'Dmanduk!Admin',
                'role' => User::ROLE_ADMIN,
                'requires_approval' => false,
            ],
            [
                'name' => 'Koordinator Kontributor',
                'email' => 'kontributor@dmanduk.test',
                'password' => 'Dmanduk!Contributor',
                'role' => User::ROLE_CONTRIBUTOR,
                'requires_approval' => false,
            ],
            [
                'name' => 'Relawan KPW',
                'email' => 'kpw@dmanduk.test',
                'password' => 'Dmanduk!KPW',
                'role' => User::ROLE_KPW,
                'requires_approval' => true,
            ],
        ];

        foreach ($accounts as $account) {
            User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'password' => $account['password'],
                    'email_verified_at' => now(),
                    'role' => $account['role'],
                    'requires_approval' => $account['requires_approval'],
                ]
            );
        }
    }
}

