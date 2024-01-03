<?php
declare(strict_types=1);

namespace Modules\Administrators\app\Http\Controllers;

use App\Enums\SupportStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\UsersStoreFormRequest;
use App\Http\Requests\Administrations\UsersUpdateFormRequest;
use App\Imports\SecretariesImport;
use App\Imports\SupervisionsImport;
use App\Models\User;
use App\Services\FlashMessage;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * SupervisorController
 */
class SecretariatController extends Controller
{
    protected FlashMessage $message;

    /**
     * @param FlashMessage $message
     */
    public function __construct(FlashMessage $message)
    {
        $this->message = $message;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $secretariats = (new User())->where('role', '=', SupportStatus::SE)->orderBy('name', 'asc')->get();

        return view('administrators::secretariats.index', compact('secretariats'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {

        if ($request->file('select_file') !== null) {
            Excel::import(new SecretariesImport(), $request->file('select_file'));
            toast('Registros importados com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
        } else {
            Alert::error('Erro!', 'Algo deu errado!');
        }

        return redirect()->back();
    }

    /**
     * @param UsersStoreFormRequest $storeFormRequest
     * @return RedirectResponse
     */
    public function store(UsersStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = (new User())->create([
            'role' => $storeFormRequest->input('role'),
            'name' => mb_strtoupper($storeFormRequest->input('name'), 'utf-8'),
            'email' => $storeFormRequest->input('email'),
        ]);
        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $secretariat = (new User())->find($id);

        $roles = DB::table('roles')->select('id', 'name')->orderBy('name', 'asc')->get();

        return view('administrators::secretariats.edit', compact('secretariat', 'roles'));

    }

    /**
     * @param Request $request
     * @param UsersUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, UsersUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {
        $secretariat = (new User())->find($id);

        $update = User::where('id', $secretariat->id)->update([
            'name' => nameCase($updateFormRequest->input('name')),
            'email' => trim($updateFormRequest->input('email')),
        ]);

        // Update roles
        $secretariat->roles()->sync($request['roles']);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateRole(Request $request, int $id): RedirectResponse
    {
        $secretariat = (new User())->find($id);

        $update = (new User())->where('id', $secretariat->id)->update([
            'role' => $request['role'],
        ]);

        if ($update) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateActive(Request $request, int $id): RedirectResponse
    {
        $secretariat = (new User())->find($id);

        $update = (new User())->where('id', $secretariat->id)->update([
            'active' => $request['active'],
        ]);

        if ($update) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateAvatar(Request $request, int $id): RedirectResponse
    {
        $secretariat = (new User())->find($id);

        if ($request['avatar'] == '') {
            $this->message->selectAvatar();

            return redirect()->back();
        }

        if ($request['avatar'] !== null) {
            $image_name = Str::slug($secretariat->name, '-') . '.' . explode(
                    '/',
                    explode(':', substr($request['avatar'], 0, strpos($request['avatar'], ';')))[1]
                )[1];

            Image::make($request['avatar'])->resize(270, 200)->save(public_path('/assets/uploads/images/users/') . $image_name);
            $request->merge(['avatar' => $image_name]);

            $secretariat_image = public_path('/assets/uploads/images/users/');
            if (file_exists($secretariat_image)) {
                @unlink($secretariat_image);
            }
        }

        $update = (new User())->where('id', $secretariat->id)->update([
            'avatar' => $request['avatar'],
        ]);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $secretariat = (new User())->find($id);

        $inactive = (new User())->where('id', $secretariat->id)->delete();

        if ($inactive) {
            $this->message->inactiveSuccess();

        } else {
            $this->message->inactiveError();

        }

        return redirect()->back();
    }

    /**
     * @return View
     */
    public function allTrashed(): View
    {
        $secretariats = (new User())::onlyTrashed()->paginate(50);

        return view('administrators::secretariats.inativos.index', compact('secretariats'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $secretariat = (new User())::onlyTrashed()->find($id);

        $restore = (new User())->where('id', $secretariat->id)->restore();

        if ($restore) {
            $this->message->restoreSuccess();

        } else {
            $this->message->restoreError();

        }

        return redirect()->back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function forceDelete(int $id): RedirectResponse
    {
        $secretariat = (new User())::onlyTrashed()->find($id);

        $inactive = (new User())->where('id', $secretariat->id)->forceDelete();

        if ($inactive) {
            $this->message->forceDeleteSuccess();

        } else {
            $this->message->forceDeleteError();

        }

        return redirect()->back();

    }
}
