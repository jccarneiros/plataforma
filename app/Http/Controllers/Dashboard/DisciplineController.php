<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\DisciplinesStoreFormRequest;
use App\Http\Requests\Administrations\DisciplinesUpdateFormRequest;
use App\Imports\DisciplinesImport;
use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Components\DisciplinesRepository;
use App\Repositories\Components\TipoEnsinosRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

/**
 *DisciplineController
 */
class DisciplineController extends Controller
{
    protected DisciplinesRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(DisciplinesRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * @return View
     */
    public function index($tipoEnsinoId, $serieId, $room): View
    {
        $tipoEnsino = DB::table('tipo_ensinos')->where('id', '=', $tipoEnsinoId)->find($tipoEnsinoId);

        $serie = DB::table('series')->where('id', '=', $serieId)->find($serieId);

        $room = Room::with('fechamentos')->find($room);

        $teachers = User::where('role', 'Professor(a)')->orderBy('name', 'asc')->get();

        return view('dashboard.rooms.disciplines', compact('tipoEnsino', 'serie', 'room', 'teachers'));
    }

    /**
     * @return RedirectResponse
     */
    public function import(): RedirectResponse
    {
        $this->request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
            'tipo_ensino_id' => 'required',
            'serie_id' => 'required',
            'room_id' => 'required',
        ]);

        $import = Excel::import(new DisciplinesImport(), request()->file('select_file'));

        if ($import) {
            $this->message->importSuccess();
        } else {
            $this->message->importError();
        }

        return redirect()->back()->with('success', 'Registros importados com sucesso!');
    }

    public function store(DisciplinesStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository::create([
            'tipo_ensino_id' => $storeFormRequest->input('tipo_ensino_id'),
            'serie_id' => $storeFormRequest->input('serie_id'),
            'room_id' => $storeFormRequest->input('room_id'),
            'name' => nameCase($storeFormRequest->input('name')),
            'a_p_p_b' => 0,
            'a_d_p_b' => 0,
            'a_p_s_b' => 0,
            'a_d_s_b' => 0,
            'a_p_t_b' => 0,
            'a_d_t_b' => 0,
            'a_p_q_b' => 0,
            'a_d_q_b' => 0,
            't_a_d_ano' => 0,
        ]);
        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    /**
     * @param DisciplinesUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(DisciplinesUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {

        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'name' => nameCase($updateFormRequest->input('name')),
        ]);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function updateTeacher(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'user_id' => $this->request['user_id'],
        ]);

        if ($update) {
//            $this->message->updateSuccess();
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

        $delete = $this->repository::delete($item->id);

        if ($delete) {
//            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }

    public function createTableFechamento()
    {
        if (Fechamento::where('discipline_id', '=', request()->input('discipline_id'))->exists()) {
            Alert::error('Atenção!', 'Essa tabela já existe!');

            return redirect()->back();
        } elseif ($this->request->student_id == '') {
            Alert::error('Atenção!', 'Não existe alunos(a) associados à essa turma!');

            return redirect()->back();
            // Verifica se existe professor relacionados com a discipline
        } else {
            foreach ($this->request->discipline_id as $item => $value) {
                $dataStore = [
                    'tipo_ensino_id' => $this->request->tipo_ensino_id[$item],
                    'serie_id' => $this->request->serie_id[$item],
                    'room_id' => $this->request->room_id[$item],
                    'discipline_id' => $this->request->discipline_id[$item],
                    'student_id' => $this->request->student_id[$item],
                    'number_ra' => $this->request->number_ra[$item],
                    'student_number' => $this->request->student_number[$item],
                    'student_name' => $this->request->student_name[$item],
                    'student_situation' => $this->request->student_situation[$item],
                    'a_p_p_b' => '0',
                    'a_d_p_b' => '0',
                    'a_p_s_b' => '0',
                    'a_d_s_b' => '0',
                    'a_p_t_b' => '0',
                    'a_d_t_b' => '0',
                    'a_p_q_b' => '0',
                    'a_d_q_b' => '0',
                    't_a_a_ano' => '0',
                    'f_p_b' => '0',
                    'f_c_p_b' => '0',
                    'f_s_b' => '0',
                    'f_c_s_b' => '0',
                    'f_t_b' => '0',
                    'f_c_t_b' => '0',
                    'f_q_b' => '0',
                    'f_c_q_b' => '0',
                ];
                $student = Fechamento::create($dataStore);
            }

            if ($student) {
                toast('Registros criados com sucesso!', 'success')->autoClose(1000)->timerProgressBar();

                return redirect()->back();
            } else {
                Alert::error('Erro!', 'Não foi possível criar os registros!');

                return redirect()->back();
            }
        }
    }

    public function createTableFechamentoStudentNew()
    {
        if (DB::table('fechamentos')
            ->where('tipo_ensino_id', '=', $this->request->tipo_ensino_id)
            ->where('serie_id', '=', $this->request->serie_id)
            ->where('student_id', '=', $this->request->student_id)
            ->exists()) {
            Alert::error('Erro!', 'Este aluno já está cadastrado!');

            return redirect()->back();
        } elseif (is_array($this->request->discipline_id) == 0 || is_array($this->request->user_id) == 0) {
            Alert::warning('Atenção!', 'Não existe disciplina cadastrada ou existe disciplinas sem professor!');

            return redirect()->back();
        } elseif (is_array($this->request->discipline_id) === is_array($this->request->user_id)) {
            $studentId = $this->request->input('student_id');
            $studentNumberRa = $this->request->input('number_ra');
            $studentNumber = $this->request->input('student_number');
            $studentName = $this->request->input('student_name');
            $sstudentSituation = $this->request->input('student_situation');
            foreach ($this->request->discipline_id as $item => $value) {
                $dataStore = [
                    'student_id' => $studentId,
                    'number_ra' => $studentNumberRa,
                    'student_number' => $studentNumber,
                    'student_name' => $studentName,
                    'student_situation' => $sstudentSituation,
                    'tipo_ensino_id' => $this->request->tipo_ensino_id[$item],
                    'serie_id' => $this->request->serie_id[$item],
                    'room_id' => $this->request->room_id[$item],
                    'discipline_id' => $this->request->discipline_id[$item],
                    'user_id' => $this->request->user_id[$item],
                ];
                $student = Fechamento::create($dataStore);
            }
            if ($student) {
                toast('Registros criados com sucesso!', 'success');

                return redirect()->back();
            } else {
                Alert::error('Erro!', 'Não foi possível criar os registros!');

                return redirect()->back();
            }
        } else {
            Alert::warning('Atenção!', 'Existe disciplinas sem professor!');

            return redirect()->back();
        }
    }

    public function updateDisciplines($tipoEnsinoId, $serieId, $room)
    {
        $tipoEnsino = DB::table('tipo_ensinos')->where('id', '=', $tipoEnsinoId)->find($tipoEnsinoId);

        $serie = DB::table('series')->where('id', '=', $serieId)->find($serieId);

        $room = Room::with('fechamentos')->find($room);

        $teachers = User::where('role', 'Professor(a)')->orderBy('name', 'asc')->get();

        $search = $this->request->input('search');

        $item = Student::with('tipoEnsino', 'serie', 'room')
            ->where('number_ra', '=', $search)
            ->first();

        $adicionarNewStudentFechamento = Student::with('tipoEnsino', 'serie', 'room')->where('number_ra', 'LIKE', $search)->get();

        $fechamentos = Fechamento::with('student')
            ->where('number_ra', 'LIKE', $search)
            ->get();

        return view('dashboard.rooms.disciplines',
            compact('tipoEnsino', 'serie', 'room', 'teachers', 'search', 'item', 'fechamentos', 'adicionarNewStudentFechamento'));

    }

    public function updateStudentFechamento(int $id): RedirectResponse
    {
        $item = Fechamento::find($id);

        $update = Fechamento::where('id', '=', $item->id)->update([
            'discipline_id' => $this->request['discipline_id'],
        ]);

        if ($update) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }
}
