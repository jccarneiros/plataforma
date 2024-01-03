<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaConhecimento extends Model
{
    protected $guard = ['auth'];

    protected $table = 'area_conhecimentos';

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
        'name',
    ];

    public static function boot()
    {
        parent::boot();

        self::deleting(
            function ($model) {
                $model->areaConhecimentoUsers()->each(
                    function ($user) {
                        $user->delete();
                    }
                );
            }
        );

        self::deleting(
            function ($model) {
                $model->documentTypes()->each(
                    function ($document) {
                        $document->delete();
                    }
                );
            }
        );

        self::deleting(
            function ($model) {
                $model->documentPeriods()->each(
                    function ($document) {
                        $document->delete();
                    }
                );
            }
        );

        self::deleting(
            function ($model) {
                $model->disciplinas()->each(
                    function ($disciplina) {
                        $disciplina->delete();
                    }
                );
            }
        );
    }

    public function areaConhecimentoUsers(): HasMany
    {
        return $this->hasMany(AreaConhecimentoUser::class);
    }

    public function documentTypes(): HasMany
    {
        return $this->hasMany(DocumentType::class)->orderBy('name', 'asc');
    }

    public function documentPeriods(): HasMany
    {
        return $this->hasMany(DocumentPeriod::class);
    }

    public function userDocumentPeriods(): HasMany
    {
        return $this->hasMany(CreateDocumentPeriod::class)->where('user_id', '=', auth()->user()->id);
    }

    public function disciplinas(): HasMany
    {
        return $this->hasMany(Disciplina::class);
    }
}
