<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\ProfessorsStoreFormRequest;
use App\Models\Eletiva;
use App\Models\Professor;
use App\Models\Sala;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Components\ProfessorsRepository;
use App\Services\FlashMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *ProfessorController
 */
class ProfessorController extends Controller
{
    protected ProfessorsRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(ProfessorsRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function index(): View
    {
        $professors = Professor::with('sala', 'user', 'students')
            ->orderBy('sala_id', 'asc')->orderBy('user_id', 'asc')
            ->get();


        $users = User::whereDoesntHave('professor')->where('role', '=', 'Professor(a)')
            ->orderBy('name', 'asc')->get();

        $salas = Sala::whereDoesntHave('professor')->orderBy('name', 'asc')->get();

        return view('dashboard.professors.index', compact('professors', 'salas','users'));
    }

    public function store(ProfessorsStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository::create([
            'sala_id' => $storeFormRequest->input('sala_id'),
            'user_id' => $storeFormRequest->input('user_id'),
            'name_eletiva' => $storeFormRequest->input('name_eletiva'),
            'status_eletiva' => $storeFormRequest->input('status_eletiva'),
            'limit_eletiva_students' => $storeFormRequest->input('limit_eletiva_students'),
        ]);
        if ($store) {
//            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    public function eletivas($id)
    {
        $professor = Professor::with('sala','user','students')->where('id', '=', $id)->find($id);

        $salas = Sala::whereDoesntHave('professor')->orderBy('name', 'asc')->get();

        $users = User::whereDoesntHave('professor')->where('role', '=', 'Professor(a)')
            ->orderBy('name', 'asc')->get();

        $eletivas = Eletiva::with('professor', 'student')->where('professor_id', '=', $professor->id)->get();



        $students = Student::whereDoesntHave('eletiva')->with('room')
            ->where('type', 'Regular')->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc')->get();

        return view('dashboard.professors.eletivas', compact('professor', 'salas','users','students', 'eletivas'));
    }

    public function storeStudentEletivas(): RedirectResponse
    {
        $store = Eletiva::create([
            'professor_id' => $this->request->input('professor_id'),
            'student_id' => $this->request->input('student_id'),
        ]);
        if ($store) {
//            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    public function updateSala($id)
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'sala_id' => $this->request->input('sala_id'),
        ]);

        if ($update) {
//            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function updateStatusProfessor($id)
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'status_eletiva' => $this->request->input('status_eletiva'),
        ]);

        if ($update) {
//            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function updateLimitProfessor($id)
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'limit_eletiva_students' => $this->request->input('limit_eletiva_students'),
        ]);

        if ($update) {
//            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function studentsEletivaPdf($id)
    {

        $professor = Professor::where('id', $id)->first();

        $eletivas = Eletiva::with('student')->where('professor_id', '=', $id)->orderBy('created_at', 'asc')->get();

//        dd($eletivas);
        $pdf = PDF::loadView('dashboard.professors.pdf-professor-students', compact('professor', 'eletivas'));

        return $pdf->setPaper('A4')->stream('Lista de alunos eletiva');
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
            DB::table('eletivas')->where('professor_id', '=', $item->id)->delete();
//            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }
}
