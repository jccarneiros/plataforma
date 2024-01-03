<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin EloquentBuilder
 * @mixin QueryBuilder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admin',
        'role',
        'name',
        'email',
        'avatar',
        'password',
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

    public static function boot(): void
    {
        parent::boot();

        self::deleting(
            static function ($model) {
                $model->permissions()->each(
                    function ($permission) {
                        $permission->delete();
                    }
                );
            }
        );
    }

    public function areaConhecimentoUsers(): HasMany
    {
        return $this->hasMany(AreaConhecimentoUser::class);
    }


    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->super_admin === 1;
    }

    /**
     * @return HasOne
     */
    public function tutor(): HasOne
    {
        return $this->hasOne(Tutor::class);
    }

    /**
     * @return HasOne
     */
    public function president(): HasOne
    {
        return $this->hasOne(President::class);
    }

    /**
     * @return HasOne
     */
    public function professor(): HasOne
    {
        return $this->hasOne(Professor::class);
    }

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($role): bool
    {
        if (is_string($role)) {
            return $this->roles()->contains('name', $role);
        }

        return (bool) $role->intersect($this->roles)->count();
    }

    public function hasPermissionRole(Permission $permission): bool
    {
        return $this->hasRole($permission->roles);
    }

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
}
