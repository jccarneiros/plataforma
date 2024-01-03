<?php
declare(strict_types=1);

namespace Modules\Administrators\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\RolesStoreFormRequest;
use App\Http\Requests\Administrations\RolesUpdateFormRequest;
use App\Models\Role;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * SupervisorController
 */
class RoleController extends Controller
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
        $roles = (new Role())->orderBy('name', 'asc')->get();

        return view('administrators::roles.index', compact('roles'));
    }

    /**
     * @param RolesStoreFormRequest $storeFormRequest
     * @return RedirectResponse
     */
    public function store(RolesStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = (new Role())->create([
            'name' => titleCase($storeFormRequest->input('name'))
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
        $role = (new Role())->find($id);

        $permissions = DB::table('permissions')->select('id', 'name', 'slug')
            ->orderBy('id', 'asc')->get();

        return view('administrators::roles.edit', compact('role', 'permissions'));

    }

    /**
     * @param Request $request
     * @param RolesUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, RolesUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {
        $role = (new Role())->find($id);

        $update = Role::where('id', $role->id)->update([
            'name' => titleCase($updateFormRequest->input('name'))
        ]);

        // Atualizar permissions
        $role->permissions()->sync($request->get('permissions'));

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
        $role = (new Role())->find($id);

        $inactive = (new Role())->where('id', $role->id)->delete();

        if ($inactive) {
            $this->message->inactiveSuccess();

        } else {
            $this->message->inactiveError();

        }

        return redirect()->back();
    }
}
