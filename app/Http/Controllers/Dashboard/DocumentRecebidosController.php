<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AreaConhecimento;
use App\Models\AreaConhecimentoUser;
use App\Models\CreateDocumentPeriod;
use App\Models\DocumentPeriod;
use App\Models\DocumentType;
use App\Services\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *DocumentRecebidosController
 */
class DocumentRecebidosController extends Controller
{
    protected Request $request;
    protected FlashMessage $message;

    public function __construct(Request $request, FlashMessage $message)
    {
        $this->request = $request;
        $this->message = $message;
    }

    public function index($areaConhecimento, $documentType)
    {
        $areaconhecimento = AreaConhecimento::where('id', '=', $areaConhecimento)->first();

        $areaConhecimentoUsers = AreaConhecimentoUser::with('areaConhecimento', 'user')
            ->where('area_conhecimento_id', '=', $areaconhecimento->id)->get();

        $documenttype = DocumentType::where('id', '=', $documentType)->first();

        return view('dashboard.documents.document-recebidos.index', compact('areaConhecimentoUsers', 'areaconhecimento', 'documenttype'));

    }

    public function filterDocumentRecebidosUsuarios($areaConhecimento, $documentType)
    {
        $areaconhecimento = AreaConhecimento::where('id', '=', $areaConhecimento)->first();

        $documenttype = DocumentType::where('id', '=', $documentType)->first();

        $areaConhecimentoUsers = AreaConhecimentoUser::with('areaConhecimento', 'user')
            ->where('area_conhecimento_id', '=', $areaconhecimento->id)->get();

        $user = $this->request->input('user');


        $userDocuments = CreateDocumentPeriod::with('areaConhecimento', 'documentType', 'documentPeriod', 'tipoEnsino', 'serie', 'discipline', 'user')
            ->where('area_conhecimento_id', '=', $areaconhecimento->id)
            ->where('document_type_id', '=', $documenttype->id)
            ->where('user_id', 'LIKE', $user)
            ->get();


        return view('dashboard.documents.document-recebidos.index',
            compact('areaConhecimentoUsers', 'areaconhecimento', 'documenttype', 'userDocuments', 'user'));

    }
}
