<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\President;
use App\Repositories\AbstractRepository;

class PresidentsRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = President::class;
}
