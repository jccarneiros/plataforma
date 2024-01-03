<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Tutor;
use App\Repositories\AbstractRepository;

class TutorsRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Tutor::class;
}
