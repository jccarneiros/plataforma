<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentPeriod extends Model
{
    protected $table = 'document_periods';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'area_conhecimento_id',
        'document_type_id',
        'tipo_ensino',
        'serie',
        'disciplina',
        'name',
        'periodicidade',
        'referencia',
        'date_initial',
        'date_final',
        'date_limit',
        'slug',
    ];

    public function areaConhecimento(): BelongsTo
    {
        return $this->belongsTo(AreaConhecimento::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function userDocumentPeriods(): HasMany
    {
        return $this->hasMany(CreateDocumentPeriod::class);
    }
}
