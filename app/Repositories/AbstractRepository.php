<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AbstractRepository implements RepositoryInterface
{
    protected static $model;

    public static function loadModel(): Model
    {
        return app(static::$model);
    }

    public static function searchByName($search, string $orderBy, string $direction): LengthAwarePaginator
    {
        return self::loadModel()::query()->where('name', 'LIKE', '%'.$search.'%')
            ->orderBy($orderBy, $direction)
            ->paginate(15);
    }

    public static function searchByNameEmail(string $search, string $orderBy, string $direction): LengthAwarePaginator
    {
        return self::loadModel()::query()->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('email', 'LIKE', '%'.$search.'%')
            ->orderBy($orderBy, $direction)
            ->paginate(10);
    }

    public static function searchByNameRelations(array $relations, string $search, string $orderBy, string $direction): LengthAwarePaginator
    {
        return self::loadModel()::query()->with($relations)
            ->where('name', 'LIKE', '%'.$search.'%')
            ->orderBy($orderBy, $direction)
            ->paginate(10);
    }

    public static function searchByNameRelationsSeries(array $relations, string $search, string $oneOrderBy, string $oneDirection, string $twoOrderBy, string $twoDirection): Collection|array
    {
        return self::loadModel()::query()->with($relations)
            ->where('name', 'LIKE', '%'.$search.'%')
            ->orderBy($oneOrderBy, $oneDirection)
            ->orderBy($twoOrderBy, $twoDirection)
            ->get();
    }

    public static function searchByNameRelationsRooms(array $relations, string $search, string $oneOrderBy, string $oneDirection, string $twoOrderBy, string $twoDirection, string $treeOrderBy, string $treeDirection): LengthAwarePaginator
    {
        return self::loadModel()::query()->with($relations)
            ->where('name', 'LIKE', '%'.$search.'%')
            ->orderBy($oneOrderBy, $oneDirection)
            ->orderBy($twoOrderBy, $twoDirection)
            ->orderBy($treeOrderBy, $treeDirection)
            ->paginate(10);
    }

    public static function searchByNameRelationsUser(array $relations, string $search, string $orderBy, string $direction): LengthAwarePaginator
    {
        return self::loadModel()::query()->with($relations)
            ->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('email', 'LIKE', '%'.$search.'%')
            ->orderBy($orderBy, $direction)
            ->paginate(10);
    }

    public static function getUserSupervisions(string $orderBy, string $direction): Collection
    {
        return self::loadModel()::query()
            ->where('role', '=', 'Supervisão')
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public static function getRoles(string $orderBy, string $direction): Collection
    {
        return self::loadModel()::query()
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public static function getUserManagements(string $orderBy, string $direction): Collection
    {
        return self::loadModel()::query()
            ->where('role', '=', 'Gestão')
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public static function getUserCoordinations(string $orderBy, string $direction): Collection
    {
        return self::loadModel()::query()
            ->where('role', '=', 'Coordenação')
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public static function getUserSecretaries(string $orderBy, string $direction): Collection
    {
        return self::loadModel()::query()
            ->where('role', '=', 'Secretaria')
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public static function getUserTeachers(string $orderBy, string $direction): Collection
    {
        return self::loadModel()::query()
            ->where('role', '=', 'Professor(a)')
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public static function getAll(): Collection
    {
        return self::loadModel()::all();
    }

    public static function getPaginate(): LengthAwarePaginator
    {
        return self::loadModel()::query()->paginate(50);
    }

    public static function allTrashed(): LengthAwarePaginator
    {
        return self::loadModel()::query()->onlyTrashed()->paginate(100);
    }

    // Retorna o id da model

    public static function find(int $id): ?Model
    {
        return self::loadModel()::query()->find($id);
    }

    public static function findOlyTrashed(int $id): ?Model
    {
        return self::loadModel()::query()->onlyTrashed()->findOrFail($id);
    }

    public static function create(array $attributes = []): ?Model
    {
        return self::loadModel()::query()->create($attributes);
    }

    public static function update(int $id, array $attributes = []): int
    {
        return self::loadModel()::query()->where(['id' => $id])->update($attributes);
    }

    public static function delete($id): int
    {
        return self::loadModel()::query()->where(['id' => $id])->delete();
    }

    public static function restore($id): int
    {
        // Restaura o registro
        return self::loadModel()::query()->withTrashed()->where(['id' => $id])->restore();

    }

    public static function forceDelete(int $id): int
    {
        return self::loadModel()::query()->where(['id' => $id])->forceDelete();
    }

    public static function sendDocumentGoogleDrive(int $user, int $area_conhecimento, int $document_type, int $document_period, array $attributes = []): ?Model
    {
        return self::loadModel()::query()->create($attributes);
    }
}
