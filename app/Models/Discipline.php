<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Discipline
 */
class Discipline extends Model
{
    protected $table = 'disciplines';

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = [];

    public $timestamps = true;

    protected $casts = [
        'id' => 'int',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tipo_ensino_id',
        'serie_id',
        'room_id',
        'code',
        'name',
        'a_p_p_b',
        'a_d_p_b',
        'a_p_s_b',
        'a_d_s_b',
        'a_p_t_b',
        'a_d_t_b',
        'a_p_q_b',
        'a_d_q_b',
        't_a_d_ano',
    ];

    public static function boot()
    {
        parent::boot();
        self::deleting(
            function ($model) {
                $model->fechamentos()->each(
                    function ($fechamento) {
                        $fechamento->delete();
                    }
                );
            }
        );
    }

    /**
     * @param $model
     * @param string $string
     * @param $number_ra
     * @return mixed
     */
    public function getNumberRa($model, string $string, $number_ra): mixed
    {
        return $model->where($string, $number_ra)->first();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'number_ra';
    }

    /**
     * @return BelongsTo
     */
    public function tipoEnsino(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TipoEnsino::class);
    }

    /**
     * @return BelongsTo
     */
    public function serie(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    /**
     * @return BelongsTo
     */
    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function fechamentos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Fechamento::class);
    }

}
