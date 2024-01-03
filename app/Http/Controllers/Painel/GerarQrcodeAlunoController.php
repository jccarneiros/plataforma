<?php
declare(strict_types=1);

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Room;
use App\Models\Student;
use App\Repositories\Components\AlunosRepository;
use App\Services\FlashMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 *GerarQrcodeAlunoController
 */
class GerarQrcodeAlunoController extends Controller
{
    protected AlunosRepository $repository;

    protected Request $request;

    protected FlashMessage $message;

    public $data;

    public $item;
    protected Aluno $model;

    public function __construct(Aluno $model, AlunosRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
        $this->model = $model;
    }

    public function gerarQrcodeAluno()
    {

        $url = "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{$this->request->input('number_ra')}";

        Storage::disk('local')->put('/public/images/qrcodes/' . $this->request->input('number_ra') . '.png', file_get_contents($url));

        $fileName = $this->request->input('number_ra') . '.png';

        $aluno = DB::table('alunos')->select('qrcode')->where('id', '=', $this->request->input('id'))->first();

//        Storage::disk('google')->putFileAs('ArquivosPlataforma/QrCodes/', $url, $fileName);

        if ($aluno->qrcode == '') {
            Aluno::where('id', $this->request->input('id'))->update([
                'qrcode' => $fileName
            ]);
        } else {
            $this->message->existImageQrcode();
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function gerarQrcodeAlunos($ra)
    {
        $aluno = Aluno::select('number_ra')->where('number_ra', '=', $ra)->first();

        if (!isset($aluno->number_ra)) {
            return redirect()->back();
        } else {
            $aluno = Aluno::where('number_ra', '=', $ra)->first();
            $qrcode = QrCode::size(150)->generate("/dashboard/alunos/cadastrar/qrcode/{$aluno->number_ra}");

            return view('dashboard.alunos.gerar-qrcode', compact('qrcode', 'aluno'))->layout('layouts.master');
        }
    }

    public function gerarQrcodeAlunosImage($ra)
    {
//        dd($this->request->all());
        $aluno = Aluno::select('id','number_ra', 'qrcode')->where('number_ra', '=', $ra)->first();

//        dd($aluno);

        if ($aluno->qrcode == '') {
            Aluno::where('number_ra', $ra)->update([
                'qrcode' => $this->request->input('qrcode'),
            ]);
            $this->message->updateSuccess();
        } else {
            $this->message->existImageQrcode();
        };

        return redirect()->back();
    }
}
