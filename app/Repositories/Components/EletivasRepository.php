<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Eletiva;
use App\Repositories\AbstractRepository;

class EletivasRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Eletiva::class;
}
