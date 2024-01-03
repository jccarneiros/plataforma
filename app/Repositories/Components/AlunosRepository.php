<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Aluno;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *AlunosRepository
 */
class AlunosRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Aluno::class;

}
