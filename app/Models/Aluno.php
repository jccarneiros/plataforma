<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *Alunos
 */
class Aluno extends Model
{
    protected $table = 'alunos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'number_ra',
        'number_ra_digit',
        'uf_ra',
        'date_birth',
        'email_microsoft',
        'email_google',
        'student_situation',
        'avatar',
        'qrcode',
    ];
}
