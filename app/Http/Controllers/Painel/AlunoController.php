<?php
declare(strict_types=1);

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Repositories\Components\AlunosRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *AlunosController
 */
class AlunoController extends Controller
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

    /**
     * @return View
     */
    public function index(): View
    {

        $searchAluno = $this->request->input('searchAluno');

        $alunos = Aluno::orWhere('name', 'LIKE', '%' . $searchAluno . '%')
            ->orWhere('number_ra', 'LIKE', '%' . $searchAluno . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        $alunosCount = DB::table('alunos')->count();

        return view('painel.alunos.index', compact('alunos', 'alunosCount'));

    }
}
