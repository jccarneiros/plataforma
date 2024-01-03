<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\DocumentTypesStoreFormRequest;
use App\Models\AreaConhecimento;
use App\Models\DocumentType;
use App\Repositories\Components\DocumentTypesRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 *DocumentTypeController
 */
class DocumentTypeController extends Controller
{
    protected DocumentTypesRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    public function __construct(DocumentTypesRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    public function index($areaConhecimento): View
    {
        $areaconhecimento = AreaConhecimento::where('id', '=', $areaConhecimento)->first();

        $data = DocumentType::with('areaConhecimento', 'documentPeriods')->where('area_conhecimento_id', $areaConhecimento)->get();

        return view('dashboard.documents.document-types.index', compact('areaconhecimento', 'data'));
    }

    public function store(DocumentTypesStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository->create([
            'area_conhecimento_id' => $storeFormRequest['area_conhecimento_id'],
            'name' => nameCase($storeFormRequest['name']),
            'periodicidade' => $storeFormRequest['periodicidade'],
            'slug' => Str::slug($storeFormRequest['name']),

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
            'periodicidade' => $this->request->input('periodicidade'),
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
