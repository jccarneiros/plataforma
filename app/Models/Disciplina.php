<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disciplina extends Model
{
    protected $guard = ['auth'];

    protected $table = 'disciplinas';

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'id' => 'int',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_conhecimento_id',
        'name',
    ];

    public function areaConhecimento(): BelongsTo
    {
        return $this->belongsTo(AreaConhecimento::class);
    }
}
