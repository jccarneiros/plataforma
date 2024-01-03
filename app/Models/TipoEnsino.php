<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 * @method static create(array $array)
 * @method static where(string $string, $id)
 */
class TipoEnsino extends Model
{
    protected $table = 'tipo_ensinos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'slug',
    ];

    public static function boot(): void
    {
        parent::boot();

        self::deleting(
            function ($model) {
                $model->series()->each(
                    function ($serie) {
                        $serie->delete();
                    }
                );
            }
        );

        self::deleting(
            function ($model) {
                $model->rooms()->each(
                    function ($room) {
                        $room->delete();
                    }
                );
            }
        );

        self::deleting(
            function ($model) {
                $model->students()->each(
                    function ($student) {
                        $student->delete();
                    }
                );
            }
        );
    }

    public function series(): HasMany
    {
        return $this->hasMany(Serie::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * @return HasMany
     */
    public function fechamentos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Fechamento::class);
    }

    /**
     * @return HasMany
     */
    public function entrances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RegisterEntrancesStudent::class);
    }

    /**
     * @return HasMany
     */
    public function outputs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RegisterOutputsStudent::class);
    }
}
