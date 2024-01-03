<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Professor;
use App\Repositories\AbstractRepository;

class ProfessorsRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Professor::class;
}
