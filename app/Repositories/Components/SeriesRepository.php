<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Serie;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 *SeriesRepository
 */
class SeriesRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Serie::class;

    /**
     * @param array $relations
     * @param string $orderByOne
     * @param string $directionOne
     * @param string $orderByTwo
     * @param string $directionTwo
     * @return Collection
     */
    public static function getSeries(array $relations, string $orderByOne, string $directionOne, string $orderByTwo, string $directionTwo): Collection
    {
        return self::loadModel()::query()->with($relations)
            ->orderBy($orderByOne, $directionOne)->orderBy($orderByTwo, $directionTwo)->get();
    }
}
