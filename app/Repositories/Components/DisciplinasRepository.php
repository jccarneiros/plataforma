<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Disciplina;
use App\Repositories\AbstractRepository;

class DisciplinasRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Disciplina::class;
}
