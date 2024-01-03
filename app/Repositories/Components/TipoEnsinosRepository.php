<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\TipoEnsino;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * TipoEnsinosRepository
 */
class TipoEnsinosRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = TipoEnsino::class;

    /**
     * @param array $relations
     * @param string $orderBy
     * @param string $direction
     * @return Collection
     */
    public static function getTipoEnsinos(array $relations, string $orderBy, string $direction): Collection
    {
        return self::loadModel()::query()->with($relations)->orderBy($orderBy, $direction)->get();
    }
}
