<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public static function getAll(): Collection;

    public static function getPaginate(): LengthAwarePaginator;

    public static function allTrashed(): LengthAwarePaginator;

    public static function create(array $attributes): ?Model;

    public static function find(int $id): ?Model;

    public static function findOlyTrashed(int $id): ?Model;

    public static function update(int $id, array $attributes): int;

    public static function delete(int $id): int;

    public static function forceDelete(int $id): int;

    public static function restore(int $id): int;

    public static function searchByName(string $search, string $orderBy, string $direction): LengthAwarePaginator;

    public static function searchByNameEmail(string $search, string $orderBy, string $direction): LengthAwarePaginator;

    public static function searchByNameRelations(array $relations, string $search, string $orderBy, string $direction): LengthAwarePaginator;

    public static function searchByNameRelationsUser(array $relations, string $search, string $orderBy, string $direction): LengthAwarePaginator;

    public static function getUserSupervisions(string $orderBy, string $direction): Collection;

    public static function getUserManagements(string $orderBy, string $direction): Collection;

    public static function getUserCoordinations(string $orderBy, string $direction): Collection;

    public static function getUserSecretaries(string $orderBy, string $direction): Collection;

    public static function getUserTeachers(string $orderBy, string $direction): Collection;

    public static function searchByNameRelationsSeries(array $relations, string $search, string $oneOrderBy, string $oneDirection, string $twoOrderBy, string $twoDirection): mixed;

    public static function searchByNameRelationsRooms(array $relations, string $search, string $oneOrderBy, string $oneDirection, string $twoOrderBy, string $twoDirection, string $treeOrderBy, string $treeDirection): LengthAwarePaginator;

    public static function loadModel(): Model;

    public static function sendDocumentGoogleDrive(int $user, int $area_conhecimento, int $document_type, int $document_period, array $attributes): ?Model;
}
