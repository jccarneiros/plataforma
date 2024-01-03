<?php

declare(strict_types=1);

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Fechamento
 */
class Fechamento extends Model
{
    protected $table = 'fechamentos';

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = [];

    protected $casts = [
        'id' => 'int',
    ];

    protected $fillable = [
        'tipo_ensino_id',
        'serie_id',
        'room_id',
        'discipline_id',
        'student_id',
        'number_ra',
        'student_number',
        'student_name',
        'student_situation',
        'n_p_b',
        'f_p_b',
        'f_c_p_b',
        'a_p_p_b',
        'a_d_p_b',
        'n_s_b',
        'f_s_b',
        'f_c_s_b',
        'a_p_s_b',
        'a_d_s_b',
        'n_t_b',
        'f_t_b',
        'f_c_t_b',
        'a_p_t_b',
        'a_d_t_b',
        'n_q_b',
        'f_q_b',
        'f_c_q_b',
        'a_p_q_b',
        'a_d_q_b',
        'n_q_c',
        't_f_bs',
        't_f_comp',
        't_f_ano',
        't_a_d_ano',
        't_f_porcentagem_ano',
        'resultado_final_student',
    ];

    // Query Scopes
    public function scopeStudentRa($query, $student_ra)
    {
        if ($student_ra) {
            return $query->where('student_ra', $student_ra);
        }
    }

    public function tipoEnsino(): BelongsTo
    {
        return $this->belongsTo(TipoEnsino::class);
    }

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    /**
     * @return BelongsTo
     */
    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Room::class)->orderBy('name', 'asc');
    }

    /**
     * @return BelongsTo
     */
    public function discipline(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Discipline::class)->orderBy('name', 'desc');
    }

    /**
     * @return BelongsTo
     */
    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
