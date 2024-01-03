<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Discipline;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * DisciplinesRepository
 */
class DisciplinesRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Discipline::class;

    /**
     * @param array $relations
     * @param string $orderBy
     * @param string $direction
     * @return Collection
     */
    public static function getDisciplines(array $relations, string $orderBy, string $direction): Collection
    {
        return self::loadModel()::query()->with($relations)->orderBy($orderBy, $direction)->get();
    }


    /**
     * @param array $relations
     * @param string $orderByOne
     * @param string $directionOne
     * @param string $orderByTwo
     * @param string $directionTwo
     * @param string $orderByTree
     * @param string $directionTree
     * @param string $orderByFour
     * @param string $directionFour
     * @return Collection
     */
    public static function listDisciplinesTeacher(array $relations, string $orderByOne, string $directionOne, string $orderByTwo, string $directionTwo, string $orderByTree, string $directionTree, string $orderByFour, string $directionFour): Collection
    {
        return self::loadModel()::query()->with($relations)->where('user_id', '=', auth()->user()->id)
            ->orderBy($orderByOne, $directionOne)->orderBy($orderByTwo, $directionTwo)
            ->orderBy($orderByTree, $directionTree)->orderBy($orderByFour, $directionFour)->get();
    }
}
