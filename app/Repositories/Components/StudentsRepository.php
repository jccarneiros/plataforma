<?php

declare(strict_types=1);

namespace App\Repositories\Components;

use App\Models\Student;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentsRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected static $model = Student::class;


    /**
     * @param array $relations
     * @param int $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getStudents(array $relations, int $paginate): LengthAwarePaginator
    {
//        return self::loadModel()::query()->with($relations)->orderBy($orderBy, $direction)->get();
        return self::loadModel()::query()->with($relations)->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc')->paginate($paginate)->withQueryString();
    }
}
