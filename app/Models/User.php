<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use function Laravel\Prompts\table;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nis',
        'dob',
        'avatar',
        'email',
        'password',
        'address',
        'disability_type',
        'classroom',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool{
        return !$this->hasRole(['student']);
    }

    public function isAdmin(): bool {
        return $this->hasRole('admin');
    }

    public function isSuperAdmin(): bool {
        return $this->hasRole('superadmin');
    }

    public function bookloans(){
        return $this->hasMany(Bookloan::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function presences(){
        return $this->hasMany(Presence::class);
    }

}
