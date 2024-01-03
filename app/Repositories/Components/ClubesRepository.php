<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Clube;
use App\Repositories\AbstractRepository;

class ClubesRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Clube::class;
}
