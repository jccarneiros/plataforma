<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Tutoria;
use App\Repositories\AbstractRepository;

class TutoriasRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Tutoria::class;
}
