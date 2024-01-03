<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Sala;
use App\Repositories\AbstractRepository;

class SalasRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Sala::class;
}
