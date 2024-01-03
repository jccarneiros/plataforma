<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\DocumentType;
use App\Repositories\AbstractRepository;

class DocumentTypesRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = DocumentType::class;
}
