<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Http\Requests\Administrations\DisciplinesStoreFormRequest;
use App\Http\Requests\Administrations\DisciplinesUpdateFormRequest;
use App\Imports\DisciplinesImport;
use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Components\DisciplinesRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * DisciplineComponent
 */
class DisciplineComponent extends Component
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
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.disciplines.discipline-component');
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
        } else {
            if ($this->request->student_id == '') {
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
    }

    public function updateDisciplines($room)
    {
        $room = Room::with('fechamentos')->find($room);

        $teachers = User::where('role', 'Professor(a)')->orderBy('name', 'asc')->get();

        $search = $this->request->input('search');

        $item = Student::with('tipoEnsino', 'serie', 'room')
            ->where('number_ra', '=', $search)
            ->first();

        $fechamentos = Fechamento::with('student')
            ->where('number_ra', 'LIKE', $search)
            ->get();

        return view('components.disciplines.discipline-component',
            compact('room', 'teachers', 'search', 'item', 'fechamentos'));

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
