<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method orderBy(string $string, string $string1)
 * @method find(int $id)
 * @method create(array $array)
 * @method where(string $string, $id)
 */
class Role extends Model
{
    protected $guard = ['auth'];

    protected $table = 'roles';

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();

        self::deleting(
            function ($model) {
                $model->permissions()->each(
                    function ($permission) {
                        $permission->delete();
                    }
                );
            }
        );
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
}
