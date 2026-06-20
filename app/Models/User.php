<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'birth_of_day',
        'address',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
        'full_name',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_of_day' => 'date',
        ];
    }

    // ============================================
    // ACCESSORS
    // ============================================
    
    public function getFullNameAttribute(): string
    {
        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        }
        return $this->name ?? $this->email;
    }

    // ============================================
    // ROLE CHECK METHODS
    // ============================================
    
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isKurir(): bool
    {
        return $this->role === 'kurir';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    // ============================================
    // GET DASHBOARD ROUTE BASED ON ROLE
    // ============================================
    
    public function getDashboardRoute(): string
    {
        return match ($this->role) {
            'admin' => route('admin.dashboard'),
            'kurir' => route('kurir.dashboard'),
            default => route('client.dashboard'),
        };
    }

    public function getDashboardView(): string
    {
        return match ($this->role) {
            'admin' => 'role-dashboards.admin',
            default => 'role-dashboards.client',
        };
    }

    // ============================================
    // SCOPES
    // ============================================
    
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeRoles($query, array $roles)
    {
        return $query->whereIn('role', $roles);
    }
}