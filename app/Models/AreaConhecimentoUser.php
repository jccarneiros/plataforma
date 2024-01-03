<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *AreaConhecimentoUser
 */
class AreaConhecimentoUser extends Model
{

    protected $guard = ['auth'];

    protected $table = 'area_conhecimento_users';

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
        'user_id',
    ];

    public function areaConhecimento(): BelongsTo
    {
        return $this->belongsTo(AreaConhecimento::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
