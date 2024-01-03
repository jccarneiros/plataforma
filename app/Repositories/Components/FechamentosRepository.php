<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Discipline;
use App\Models\Fechamento;
use App\Models\Room;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * FechamentosRepository
 */
class FechamentosRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Discipline::class;

    /**
     * @param array $relations
     * @param string $orderByOne
     * @param string $directionOne
     * @param string $orderByTwo
     * @param string $directionTwo
     * @param string $orderByTree
     * @param string $directionTree
     * @return Collection
     */
    public static function getFechamentos(array $relations, string $orderByOne, string $directionOne, string $orderByTwo, string $directionTwo, string $orderByTree, string $directionTree): Collection
    {
        return self::loadModel()::query()->with($relations)->orderBy($orderByOne, $directionOne)->orderBy($orderByTwo, $directionTwo)->orderBy($orderByTree, $directionTree)->get();
    }
}
