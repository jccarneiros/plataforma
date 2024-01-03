<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Room;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class RoomsRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Room::class;

    /**
     * @param array $relations
     * @param int $tipoEnsino
     * @param int $serie
     * @param string $orderByOne
     * @param string $directionOne
     * @param string $orderByTwo
     * @param string $directionTwo
     * @param string $orderByTree
     * @param string $directionTree
     * @return Collection
     */
    public static function getRooms(array $relations, int $tipoEnsino, int $serie, string $orderByOne, string $directionOne, string $orderByTwo, string $directionTwo, string $orderByTree, string $directionTree): Collection
    {
        return self::loadModel()::query()->with($relations)
            ->where('tipo_ensino_id', '=', $tipoEnsino)
            ->where('serie_id', '=', $serie)
            ->orderBy($orderByOne, $directionOne)->orderBy($orderByTwo, $directionTwo)->orderBy($orderByTree, $directionTree)->get();
    }
}
