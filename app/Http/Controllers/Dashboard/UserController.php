<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Enums\SupportStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\UsersUpdateFormRequest;
use App\Models\User;
use App\Repositories\Administrations\UserRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 *UserController
 */
class UserController extends Controller
{
    protected UserRepository $repository;

    protected Request $request;

    protected FlashMessage $message;
    private User $user;

    /**
     * @param UserRepository $repository
     * @param Request $request
     * @param FlashMessage $message
     */
    public function __construct(UserRepository $repository, Request $request, FlashMessage $message, User $user)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function index(): View
    {
        $searchStudentEmail = $this->request->input('searchStudentEmail');

        $filterStudentProfile = $this->request->input('filterStudentProfile');

        $users = (new User())
            ->where('email', 'LIKE', '%' . $searchStudentEmail . '%')
            ->orWhere('role', 'LIKE', $filterStudentProfile)
            ->simplePaginate(15);

//        $users = UserRepository::listUsers('role', 'asc', 10);

        $usersCount = UserRepository::getAll();

        $profiles = User::orderBy('role', 'asc')->groupBy('role')->get();
//        dd($roles);

//        $title = 'Delete User!';
//        $text = "Are you sure you want to delete?";
//        confirmDelete($title, $text);

        return view('dashboard.users.index',compact('users', 'usersCount', 'profiles'));
    }
    public function filterUserProfile($profile): View
    {
        $users = User::where('role', 'LIKE', $profile)->orderBy('name', 'asc')->paginate(100);

        $profiles = User::orderBy('role', 'asc')->groupBy('role')->get();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('dashboard.users.index', compact('users','profiles'));
    }

    public function edit(int $id): View
    {
        $item = $this->repository::find($id);

        $roles = DB::table('roles')->select('id', 'name')->orderBy('name', 'asc')->get();

        return view('dashboard.users.edit', compact('item', 'roles'));

    }

    public function updateActive(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $this->repository::update($item->id, [
            'active' => $this->request['active'],
        ]);

        return redirect()->back();

    }

    public function update(UsersUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $update = $this->repository->update($item->id, [
            'name' => $updateFormRequest['name'],
            'email' => trim($updateFormRequest['email']),
        ]);

        // Update roles
        $item->roles()->sync($this->request->get('roles'));

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function updateAvatar(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        if ($this->request->avatar == '') {
            $this->message->selectAvatar();

            return redirect()->back();
        }

        if ($this->request->avatar !== null) {
            $nameImage = Str::slug($item->name, '-').'.'.explode(
                    '/',
                    explode(':', substr($this->request->avatar, 0, strpos($this->request->avatar, ';')))[1]
                )[1];

            Image::make($this->request->avatar)->resize(270, 200)->save(public_path('/assets/uploads/images/users/').$nameImage);
            $this->request->merge(['avatar' => $nameImage]);

            $itemImage = public_path('/assets/uploads/images/users/');
            if (file_exists($itemImage)) {
                @unlink($itemImage);
            }
        }

        $update = $this->repository::update($item->id, [
            'avatar' => $this->request['avatar'],
        ]);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function delete(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $inactive = $this->repository::delete($item->id);

        if ($inactive) {
            $this->message->inactiveSuccess();

        } else {
            $this->message->inactiveError();

        }

        return redirect()->back();
    }

    public function allTrashed(): View
    {
        $data = $this->repository::allTrashed();

        return view('dashboard.users.inativos.index', compact('data'));
    }

//    public function restore(int $id): RedirectResponse
//    {
//        $restore = $this->repository::restore($id);
//
////        if ($restore) {
////            $this->message->restoreSuccess();
////
////        } else {
////            $this->message->restoreError();
////
////        }
//
//        return redirect()->back();
//    }

//    public function forceDelete(int $id): RedirectResponse
//    {
//        $item = $this->repository::findOlyTrashed($id);
//
//        $inactive = $this->repository::forceDelete($item->id);
//
//        if ($inactive) {
//            $this->message->forceDeleteSuccess();
//
//        } else {
//            $this->message->forceDeleteError();
//
//        }
//
//        return redirect()->back();
//
//    }

    /**
     * @return RedirectResponse
     */
    public function deleteUsers(): RedirectResponse
    {
       return $this->repository->deleteUsers($this->user);
    }

    /**
     * @return RedirectResponse
     */
    public function restoreUsers(): RedirectResponse
    {
        return $this->repository->restoreUsers($this->user);
    }

    /**
     * @return RedirectResponse
     */
    public function forceDeleteUsers(): RedirectResponse
    {
       return $this->repository->forceDeleteUsers($this->user);
    }
}
