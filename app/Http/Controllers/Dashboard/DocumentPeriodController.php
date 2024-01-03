<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\DocumentPeriodsStoreFormRequest;
use App\Http\Requests\Administrations\DocumentPeriodsUpdateFormRequest;
use App\Models\AreaConhecimento;
use App\Models\DocumentPeriod;
use App\Models\DocumentType;
use App\Models\TipoEnsino;
use App\Repositories\Components\DocumentPeriodsRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\NoReturn;

/**
 *DocumentPeriodController
 */
class DocumentPeriodController extends Controller
{
    protected DocumentPeriodsRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    public function __construct(DocumentPeriodsRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    public function index($areaConhecimento, $documentType): View
    {
        $areaconhecimento = AreaConhecimento::where('id', '=', $areaConhecimento)->first();
        $documenttype = DocumentType::where('id', '=', $documentType)->first();

        $data = DocumentPeriod::with('areaConhecimento', 'documentType')
            ->where('area_conhecimento_id', $areaConhecimento)
            ->where('document_type_id', $documentType)
            ->get();

        return view('dashboard.documents.document-periods.index',
            compact('areaconhecimento', 'documenttype', 'data'));
    }

    public function store(DocumentPeriodsStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository::create([
            'area_conhecimento_id' => $storeFormRequest['area_conhecimento_id'],
            'document_type_id' => $storeFormRequest['document_type_id'],
            'name' => nameCase($storeFormRequest['name']) . '-' . $storeFormRequest['date_initial'] . '-' . $storeFormRequest['date_final'],
            'periodicidade' => $storeFormRequest['periodicidade'],
            'referencia' => $storeFormRequest['referencia'],
            'date_initial' => $storeFormRequest['date_initial'],
            'date_final' => $storeFormRequest['date_final'],
            'date_limit' => $storeFormRequest['date_limit'],
            'tipo_ensino' => $storeFormRequest['tipo_ensino'],
            'serie' => $storeFormRequest['serie'],
            'disciplina' => $storeFormRequest['disciplina'],
            'slug' => Str::slug($storeFormRequest['name'] . '-' . $storeFormRequest['date_initial'] . '-' . $storeFormRequest['date_final']),
        ]);

        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }
        return redirect()->back();
    }

    public function edit(int $id)
    {
        $item = $this->repository::find($id);

//        dd($item);

        $areaconhecimento = AreaConhecimento::where('id', '=', $item->area_conhecimento_id)->first();
        $documenttype = DocumentType::where('id', '=', $item->document_type_id)->first();

        return view('dashboard.documents.document-periods.edit', compact('areaconhecimento', 'documenttype', 'item'));

    }

    public function update(DocumentPeriodsUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'area_conhecimento_id' => $updateFormRequest['area_conhecimento_id'],
            'document_type_id' => $updateFormRequest['document_type_id'],
            'name' => nameCase($updateFormRequest['name']) . '-' . $updateFormRequest['date_initial'] . '-' . $updateFormRequest['date_final'],
            'periodicidade' => $updateFormRequest['periodicidade'],
            'referencia' => $updateFormRequest['referencia'],
            'date_initial' => $updateFormRequest['date_initial'],
            'date_final' => $updateFormRequest['date_final'],
            'date_limit' => $updateFormRequest['date_limit'],
            'tipo_ensino' => $updateFormRequest['tipo_ensino'],
            'serie' => $updateFormRequest['serie'],
            'disciplina' => $updateFormRequest['disciplina'],
            'slug' => Str::slug($updateFormRequest['name'] . '-' . $updateFormRequest['date_initial'] . '-' . $updateFormRequest['date_final']),
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
