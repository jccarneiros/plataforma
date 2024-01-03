<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *Student
 */
class Student extends Model
{
    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo_ensino_id',
        'serie_id',
        'room_id',
        'number',
        'name',
        'number_ra',
        'number_ra_digit',
        'uf_ra',
        'date_birth',
        'email_microsoft',
        'email_google',
        'student_situation',
        'type',
        'slug',
        'avatar',
    ];

    public static function boot(): void
    {
        parent::boot();

        self::deleting(
            static function ($model) {
                $model->users()->each(
                    function ($user) {
                        $user->delete();
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

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function disciplines(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Discipline::class)->orderBy('student_id', 'asc');
    }

    public function fechamentos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Fechamento::class)->orderBy('student_id', 'asc');
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

    /**
     * @return HasOne
     */
    public function tutoria(): HasOne
    {
        return $this->hasOne(Tutoria::class);
    }

    /**
     * @return HasOne
     */
    public function clube(): HasOne
    {
        return $this->hasOne(Clube::class);
    }

    /**
     * @return HasOne
     */
    public function eletiva(): HasOne
    {
        return $this->hasOne(Eletiva::class);
    }

    public function entrances()
    {
        return $this->hasMany(RegisterEntrancesStudent::class);
    }

    public function outputs()
    {
        return $this->hasMany(RegisterOutputsStudent::class);
    }
}
