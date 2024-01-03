<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guard = ['auth'];

    protected $table = 'permissions';

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = ['name', 'slug'];

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
