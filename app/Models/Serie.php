<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    protected $table = 'series';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo_ensino_id',
        'name',
        'type',
        'slug',
    ];

    public static function boot(): void
    {
        parent::boot();

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

    public function tipoEnsino(): BelongsTo
    {
        return $this->belongsTo(TipoEnsino::class);
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
