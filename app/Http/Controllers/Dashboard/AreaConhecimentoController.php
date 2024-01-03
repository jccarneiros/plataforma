<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\SupportStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\AreaConhecimentosStoreFormRequest;
use App\Http\Requests\Administrations\RoomsUpdateFormRequest;
use App\Models\AreaConhecimento;
use App\Models\AreaConhecimentoUser;
use App\Models\User;
use App\Repositories\AreaConhecimentoRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AreaConhecimentoController extends Controller
{
    private string $view = 'supervisions';

    private Request $request;

    private FlashMessage $message;

    private AreaConhecimentoRepository $repository;

    public function __construct(AreaConhecimentoRepository $repository, Request $request, FlashMessage $message)
    {
        $this->request = $request;
        $this->message = $message;
        $this->repository = $repository;
    }

    public function index(): View
    {
        if ($this->request->user()->cannot('area_conhecimentos-index', AreaConhecimento::class)) {
            abort(403, 'Ação não autorizada!');
        }
        $search = $this->request->input('search');

        $data = $this->repository->searchByName($search, 'id', 'asc');

        return view('dashboard.documents.areaconhecimentos.index', compact('data'));
    }

    public function store(AreaConhecimentosStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository->create([
            'name' => nameCase($storeFormRequest['name']),
        ]);

        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();

    }

    public function users($id): View
    {
        $item = $this->repository::find($id);


        $users = User::where('super_admin', '!=', 1)->where('admin', '=', 1)->orderBy('role', 'asc')->orderBy('name', 'asc')->get();

        return view('dashboard.documents.areaconhecimentos.users', compact('item', 'users'));
    }

    public function storeUsers($id)
    {
        $item = $this->repository::find($id);

        $user = $this->request->input('user_id');

        AreaConhecimentoUser::create([
            'area_conhecimento_id' => $item->id,
            'user_id' => $user
        ]);
        return redirect()->back();

    }


    public function update(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'name' => nameCase($this->request->input('name')),
        ]);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function deleteUser($id)
    {
        AreaConhecimentoUser::where('id', $id)->delete();

        return redirect()->back();

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $inactive = $this->repository::delete($item->id);

        if ($inactive) {
            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }
}
