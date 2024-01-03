<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sala extends Model
{
    protected $table = 'salas';

    protected $dates = ['created_at', 'updated_at'];

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

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
}
