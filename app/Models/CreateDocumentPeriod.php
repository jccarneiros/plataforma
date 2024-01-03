<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *CreateDocumentPeriod
 */
class CreateDocumentPeriod extends Model
{
    protected $table = 'create_document_periods';

    protected $dates = ['created_at', 'updated_at'];

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'area_conhecimento_id',
        'document_type_id',
        'document_period_id',
        'tipo_ensino_id',
        'serie_id',
        'disciplina_id',
        'name',
        'periodicidade',
        'referencia',
        'date_initial',
        'date_final',
        'date_limit',
        'file',
    ];

    public function areaConhecimento(): BelongsTo
    {
        return $this->belongsTo(AreaConhecimento::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function documentPeriod(): BelongsTo
    {
        return $this->belongsTo(DocumentPeriod::class);
    }

    public function tipoEnsino(): BelongsTo
    {
        return $this->belongsTo(TipoEnsino::class);
    }

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
