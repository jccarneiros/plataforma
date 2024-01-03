<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AreaConhecimentoUser;
use App\Models\CreateDocumentPeriod;
use App\Models\DocumentPeriod;
use App\Models\DocumentType;
use App\Services\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 *CreateDocumentPeriodController
 */
class CreateDocumentPeriodController extends Controller
{
    protected Request $request;
    protected FlashMessage $message;
    protected CreateDocumentPeriod $model;

    public function __construct(CreateDocumentPeriod $model, Request $request, FlashMessage $message)
    {
        $this->request = $request;
        $this->message = $message;
        $this->model = $model;
    }

    public function index()
    {
        $user = AreaConhecimentoUser::with('areaConhecimento', 'user')
            ->where('user_id', '=', Auth::user()->id)->first();

        $documentTypes = DocumentType::with('areaConhecimento', 'documentPeriods', 'createDocumentPeriods')
            ->where('area_conhecimento_id', '=', $user->areaConhecimento->id)->get();

        return view('dashboard.documents.create-documents.index', compact('user', 'documentTypes'));
    }

    public function documentType($documentType)
    {
        $documenttype = DocumentType::with('areaConhecimento', 'documentPeriods', 'createDocumentPeriods')
            ->where('id', '=', $documentType)->first();

//        dd($documenttype);

        $documentPeriods = DocumentPeriod::with('areaConhecimento', 'documentType', 'userDocumentPeriods')
            ->where('document_type_id', '=', $documentType)->get();

        return view('dashboard.documents.create-documents.types', compact('documenttype', 'documentPeriods'));

    }

    public function documentPeriods($documentPeriod)
    {
        $documentperiod = DocumentPeriod::with('areaConhecimento', 'documentType', 'userDocumentPeriods')
            ->where('id', '=', $documentPeriod)->first();

        $tipoensinos = DB::table('tipo_ensinos')->select('id', 'name')->get();
        $series = DB::table('series')->select('id', 'name')->where('type', '=', 'Regular')->get();
        $disciplinas = DB::table('disciplinas')->select('id', 'name')
            ->where('area_conhecimento_id', '=', $documentperiod->areaConhecimento->id)->get();

        return view('dashboard.documents.create-documents.periods', compact('documentperiod', 'tipoensinos', 'series', 'disciplinas'));

    }

    public function documentStore()
    {
        $this->request->validate([
            'file' => 'required|file|mimes:pdf|max:512',
            'name' => 'required|string',
        ]);
        $userName = Auth::user()->name;


        $nameDocument = $this->request->input('document_name');

        if ($this->request->hasFile('file')) {
            //Verifica se o nome da file não existe
            if ($this->model->file == '') {
                $nameFile = Str::uuid() . '.pdf';
            } else {
                $nameFile = $this->model->file;
            }
            $upload = Storage::disk('google')->putFileAs(
                "ArquivosPlataforma/Documentos/$userName/$nameDocument", $this->request->file('file'), $nameFile
            );
            if (!$upload) {
                return redirect()->back()
                    ->withErrors(['errors' => 'Não foi possível enviar o arquivo!'])
                    ->withInput();
            }
        }

        $data = $this->model->create([
                'area_conhecimento_id' => $this->request->input('area_conhecimento_id'),
                'document_type_id' => $this->request->input('document_type_id'),
                'document_period_id' => $this->request->input('document_period_id'),
                'tipo_ensino_id' => $this->request->input('tipo_ensino_id'),
                'serie_id' => $this->request->input('serie_id'),
                'disciplina_id' => $this->request->input('disciplina_id'),
                'user_id' => $this->request->input('user_id'),
                'name' => $this->request->input('name'),
                'periodicidade' => $this->request->input('periodicidade'),
                'referencia' => $this->request->input('referencia'),
                'date_initial' => $this->request->input('date_initial'),
                'date_final' => $this->request->input('date_final'),
                'date_limit' => $this->request->input('date_limit'),
                'file' => $nameFile,
            ]

        );

        if ($data) {
            $this->message->storeSuccess();

            return redirect()->back();
        }

        // Retorna se houver algum erro no envio
        $this->message->storeError();

        return redirect()->back();

    }

    public function documentShow($id)
    {
        $data = $this->model->find($id);
        $userName = Auth::user()->name;

        $nameDocument = $data->documentType->name;

        // Verifica se existe o diretório $userName no Google Drive
        $pathGoogleDrive = Storage::disk('google')->exists("ArquivosPlataforma/Documentos/$userName");

        // Se existir o diretório $userName no Google Drive
        if ($pathGoogleDrive === true){
            // Retorna um array com os arquivos da $userName no Google Drive
            $files = Storage::disk('google')->files("ArquivosPlataforma/Documentos/$userName/$nameDocument");
            // Verifica se existe o arquivo no array da $userName no Google Drive
            if (in_array("ArquivosPlataforma/Documentos/$userName/$nameDocument/$data->file", $files)) {
                // Retorna o arquivo da $userName no Google Drive
                $item = Storage::disk('google')->url("ArquivosPlataforma/Documentos/$userName/$nameDocument/$data->file");
            }
        }

        return view('dashboard.documents.create-documents.show', compact( 'item'));

//        return redirect()->back();
    }

    public function documentEdit($documentPeriod)
    {
        $documentUserPeriod = CreateDocumentPeriod::with('areaConhecimento', 'documentType', 'user')
            ->where('id', '=', $documentPeriod)->first();

        $tipoensinos = DB::table('tipo_ensinos')->select('id', 'name')->get();
        $series = DB::table('series')->select('id', 'name')->where('type', '=', 'Regular')->get();
        $disciplinas = DB::table('disciplinas')->select('id', 'name')
            ->where('area_conhecimento_id', '=', $documentUserPeriod->areaConhecimento->id)->get();

        return view('dashboard.documents.create-documents.edit-periods', compact('documentUserPeriod', 'tipoensinos', 'series', 'disciplinas'));

    }

    public function documentUpdate(int $id)
    {
        $this->request->validate([
            'file' => 'required|file|mimes:pdf|max:512',
            'name' => 'required|string',
        ]);
        // Cria o objeto de usuário
        $item = $this->model->find($id);

        $nameDocument = $item->documentType->name;

        if ($this->request->hasFile('file')) {
            //Verifica se o nome da file não existe
            if ($this->model->file == '') {
                $nameFile = Str::uuid() . '.pdf';
            } else {
                $nameFile = $this->model->file;
            };
            $userName = Auth::user()->name;

            // Verifica se existe o diretório $userName no Google Drive
            $pathGoogleDrive = Storage::disk('google')->exists("ArquivosPlataforma/Documentos/$userName");

            // Se existir o diretório $userName no Google Drive
            if ($pathGoogleDrive === true){
                // Retorna um array com os arquivos da $userName do Google Drive
                $files = Storage::disk('google')->files("ArquivosPlataforma/Documentos/$userName/$nameDocument");
                // Verifica se existe o arquivo no array na $userName do Google Drive
                if (in_array("ArquivosPlataforma/Documentos/$userName/$nameDocument/$item->file", $files)) {
                    // Se existir o arquivo, exclui o arquivo no diretório $userName do Google Drive
                    Storage::disk('google')->delete("ArquivosPlataforma/Documentos/$userName/$nameDocument/$item->file");
                }
            }else{
                // Cria um novo arquivo no diretório $userName do Google Drive
                Storage::disk('google')
                    ->putFileAs("ArquivosPlataforma/Documentos/$userName/$nameDocument", $this->request->file('file'), $item->file);
            }

            //Altera os dados de registro no banco
            $update = $item->update([
                'area_conhecimento_id' => $this->request->input('area_conhecimento_id'),
                'document_type_id' => $this->request->input('document_type_id'),
                'document_period_id' => $this->request->input('document_period_id'),
                'tipo_ensino_id' => $this->request->input('tipo_ensino_id'),
                'serie_id' => $this->request->input('serie_id'),
                'disciplina_id' => $this->request->input('disciplina_id'),
                'user_id' => $this->request->input('user_id'),
                'name' => $this->request->input('name'),
                'periodicidade' => $this->request->input('periodicidade'),
                'referencia' => $this->request->input('referencia'),
                'date_initial' => $this->request->input('date_initial'),
                'date_final' => $this->request->input('date_final'),
                'date_limit' => $this->request->input('date_limit'),
                'file' => $nameFile,
            ]);
        }

        // Retorna se houver algum erro na atualização
        $this->message->updateError();

        return redirect()->back();
    }

    public function documentDelete($id): \Illuminate\Http\RedirectResponse
    {
        $item = $this->model->find($id);

        $userName = Auth::user()->name;

        $nameDocument = $item->documentType->name;

        // Verifica se existe o diretório $userName no Google Drive
        $pathGoogleDrive = Storage::disk('google')->exists("ArquivosPlataforma/Documentos/$userName");

        $files = Storage::disk('google')->files("ArquivosPlataforma/Documentos/$userName/$nameDocument");

        // Se existir o diretório $userName no Google Drive
        if ($pathGoogleDrive === true){
            // Retorna um array com os arquivos da $userName do Google Drive
            $files = Storage::disk('google')->files("ArquivosPlataforma/Documentos/$userName/$nameDocument");
            // Verifica se existe o arquivo no array na $userName do Google Drive
            if (in_array("ArquivosPlataforma/Documentos/$userName/$nameDocument/$item->file", $files)) {
                // Se existir o arquivo, exclui o arquivo no diretório $userName do Google Drive
                Storage::disk('google')->delete("ArquivosPlataforma/Documentos/$userName/$nameDocument/$item->file");
            }
        }

        $destroy = $item->delete();
        if ($destroy) {
            $this->message->destroySuccess();

            return redirect()->back();
        }

        $this->message->destroyError();

        return redirect()->back();
    }
}
