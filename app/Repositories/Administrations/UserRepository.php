<?php

/** @noinspection ALL */

declare(strict_types=1);

namespace App\Repositories\Administrations;

use App\Models\User;
use App\Repositories\AbstractRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserRepository extends AbstractRepository
{
    private Request $request;
    private FlashMessage $message;

    public function __construct(Request $request, FlashMessage $message)
    {
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * @var string
     */
    protected static $model = User::class;

    /**
     * @param array $relations
     * @return LengthAwarePaginator
     */
    public static function listUsers(string $orderBy, string $direction, int $paginate): LengthAwarePaginator
    {
        return self::loadModel()::query()->orderBy($orderBy, $direction)->paginate($paginate);
    }

    public function deleteUsers($user)
    {
        $delete = $this->request->input('delete');
//        dd($delete);

        if ($this->request->input('delete')) {
            $deletes = $user->whereIn('id', $delete)->delete();
        } else {
            $this->message->messageSelectRegisterCheckbox();
            return redirect()->back();
        }

        if ($deletes) {
            $this->message->inactiveSuccess();
        } else {
            $this->message->inactiveError();
        }
        return redirect()->back();
    }

    public function forceDeleteUsers($user)
    {
        $delete = $this->request->input('delete');
//        dd($delete);

        if ($this->request->input('delete')) {
            $deletes = $user->whereIn('id', $delete)->forceDelete();
        } else {
            $this->message->messageSelectRegisterCheckbox();
            return redirect()->back();
        }

        if ($deletes) {
            $this->message->forceDeleteSuccess();
        } else {
            $this->message->forceDeleteError();
        }
        return redirect()->back();
    }

    public function restoreUsers($user)
    {
        $restore = $this->request->input('restore');

        if ($this->request->input('restore')) {
            $restores = $user->whereIn('id', $restore)->restore();
        } else {
            $this->message->messageSelectRegisterCheckbox();
            return redirect()->back();
        }

        if ($restores) {
            $this->message->forceDeleteSuccess();
        } else {
            $this->message->forceDeleteError();
        }
        return redirect()->back();
    }
}
