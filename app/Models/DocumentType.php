<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    protected $table = 'document_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'area_conhecimento_id',
        'name',
        'slug',
        'periodicidade',
    ];

    public static function boot()
    {
        parent::boot();

        self::deleting(
            function ($model) {
                $model->documentPeriods()->each(
                    function ($document) {
                        $document->delete();
                    }
                );
            }
        );
    }

    public function areaConhecimento(): BelongsTo
    {
        return $this->belongsTo(AreaConhecimento::class);
    }

    public function documentPeriods(): HasMany
    {
        return $this->hasMany(DocumentPeriod::class)
            ->orderBy('date_limit', 'desc');
    }

    public function createDocumentPeriods(): HasMany
    {
        return $this->hasMany(CreateDocumentPeriod::class)->where('user_id', '=', auth()->user()->id);
    }

}
