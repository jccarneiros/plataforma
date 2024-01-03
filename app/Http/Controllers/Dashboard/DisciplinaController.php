<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\DisciplinasStoreFormRequest;
use App\Models\AreaConhecimento;
use App\Models\Disciplina;
use App\Repositories\Components\DisciplinasRepository;
use App\Services\FlashMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 *DisciplinaController
 */
class DisciplinaController extends Controller
{
    protected DisciplinasRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * @param DisciplinasRepository $repository
     * @param Request $request
     * @param FlashMessage $message
     */
    public function __construct(DisciplinasRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    public function index($areaConhecimento)
    {
        $areaconhecimento = AreaConhecimento::where('id', '=', $areaConhecimento)->first();

        $data = Disciplina::with('areaConhecimento')
        ->where('area_conhecimento_id', $areaConhecimento)->paginate(10);

        return view('dashboard.documents.disciplinas.index', compact('areaconhecimento', 'data'));

    }

    public function store(DisciplinasStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository->create([
            'area_conhecimento_id' => $storeFormRequest['area_conhecimento_id'],
            'name' => nameCase($storeFormRequest['name']),
        ]);

        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

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
