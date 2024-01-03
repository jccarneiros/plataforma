<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\DocumentPeriod;
use App\Repositories\AbstractRepository;

class DocumentPeriodsRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = DocumentPeriod::class;
}
