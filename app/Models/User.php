<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ──── Relationships ────

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function restockRequests(): HasMany
    {
        return $this->hasMany(RestockRequest::class);
    }

    // ──── Scopes ────

    public function scopeCustomers($query)
    {
        return $query->where('role', 'customer');
    }

    public function scopeAdmins($query)
    {
        return $query->whereIn('role', ['super_admin', 'admin', 'manager']);
    }

    public function scopeStaff($query)
    {
        return $query->where('role', 'staff');
    }

    // ──── Helpers ────

    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'manager']);
    }

    public function isStaff(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'manager', 'staff']);
    }

    /**
     * Calculate the customer's order success rate (delivered / total orders).
     */
    public function getSuccessRateAttribute(): float
    {
        $total = $this->orders()->count();
        if ($total === 0) return 0;

        $delivered = $this->orders()->delivered()->count();
        return round(($delivered / $total) * 100, 1);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isStaff();
    }
}
