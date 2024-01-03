<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $table = 'rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status_p_b',
        'status_s_b',
        'status_t_b',
        'status_q_b',
        'status_q_c',
        'tipo_ensino_id',
        'serie_id',
        'name',
        'type',
        'slug',
    ];

    public static function boot(): void
    {
        parent::boot();

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

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    public function disciplines(): HasMany
    {
        return $this->hasMany(Discipline::class)->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class)->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc');
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
