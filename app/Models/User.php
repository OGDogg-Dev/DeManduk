<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_CONTRIBUTOR = 'contributor';
    public const ROLE_KPW = 'kpw';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'requires_approval',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'requires_approval' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isContributor(): bool
    {
        return $this->role === self::ROLE_CONTRIBUTOR;
    }

    public function isKpw(): bool
    {
        return $this->role === self::ROLE_KPW;
    }

    public function requiresApproval(): bool
    {
        return (bool) $this->requires_approval;
    }

    public function hasCapability(string $capability): bool
    {
        if ($this->isAdmin() || $capability === '*') {
            return true;
        }

        if ($capability === 'admin') {
            return false;
        }

        $capabilities = $this->capabilityMap()[$this->role] ?? [];

        return in_array($capability, $capabilities, true);
    }

    /**
     * @param  list<string>  $capabilities
     */
    public function hasAnyCapability(array $capabilities): bool
    {
        foreach ($capabilities as $capability) {
            if ($this->hasCapability($capability)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<string, list<string>>
     */
    private function capabilityMap(): array
    {
        return [
            self::ROLE_ADMIN => ['*'],
            self::ROLE_CONTRIBUTOR => ['news'],
            self::ROLE_KPW => ['news', 'events', 'gallery'],
        ];
    }
}
