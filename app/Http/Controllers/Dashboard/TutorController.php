<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\TutorsStoreFormRequest;
use App\Models\Sala;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\Tutoria;
use App\Models\User;
use App\Repositories\Components\TutorsRepository;
use App\Services\FlashMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *TutorController
 */
class TutorController extends Controller
{
    protected TutorsRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(TutorsRepository $repository, Request $request, FlashMessage $message)
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
        $tutores = Tutor::with('sala', 'user', 'students')
            ->orderBy('sala_id', 'asc')->orderBy('user_id', 'asc')
            ->get();


        $users = User::whereDoesntHave('tutor')->where('admin', '=', 1)
            ->orderBy('role', 'asc')->orderBy('name', 'asc')->get();

        $salas = Sala::whereDoesntHave('tutor')->orderBy('name', 'asc')->get();


        return view('dashboard.tutors.index', compact('tutores', 'salas', 'users'));
    }

    public function store(TutorsStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository::create([
            'sala_id' => $storeFormRequest->input('sala_id'),
            'user_id' => $storeFormRequest->input('user_id'),
            'status_tutoria' => $storeFormRequest->input('status_tutoria'),
            'limit_tutoria_students' => $storeFormRequest->input('limit_tutoria_students'),
        ]);
        if ($store) {
//            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    public function tutorias(int $id)
    {
        $tutor = Tutor::with('sala', 'user', 'students')->where('id', '=', $id)->find($id);

        $salas = Sala::whereDoesntHave('tutor')->orderBy('name', 'asc')->get();

        $users = User::whereDoesntHave('tutor')->where('admin', '=', 1)
            ->orderBy('role', 'asc')->orderBy('name', 'asc')->get();

        $tutorias = Tutoria::with('tutor', 'student')
            ->where('tutor_id', '=', $tutor->id)->get();


        $students = Student::whereDoesntHave('tutoria')->with('room')
            ->where('type', 'Regular')
            ->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc')->get();

        return view('dashboard.tutors.tutorias', compact('tutor', 'salas', 'users', 'students', 'tutorias'));
    }

    public function storeStudentTutorias(): RedirectResponse
    {
        $store = Tutoria::create([
            'tutor_id' => $this->request->input('tutor_id'),
            'student_id' => $this->request->input('student_id'),
        ]);
        if ($store) {
//            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    public function updateSala(int $id)
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

    public function updateStatusTutor(int $id)
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'status_tutoria' => $this->request->input('status_tutoria'),
        ]);

        if ($update) {
//            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function updateLimitTutor(int $id)
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'limit_tutoria_students' => $this->request->input('limit_tutoria_students'),
        ]);

        if ($update) {
//            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function studentsTutoriaPdf(int $id)
    {

        $tutor = Tutor::where('id', $id)->first();

        $tutorias = Tutoria::with('student')->where('tutor_id', '=', $id)->orderBy('created_at', 'asc')->get();

//        dd($tutorias);
        $pdf = PDF::loadView('dashboard.tutors.pdf-tutor-students', compact('tutor', 'tutorias'));

        return $pdf->setPaper('A4')->stream('Lista de alunos tutoria');
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
            if (isset($item->tutorados)) {
                DB::table('tutorados')->where('tutor_id', '=', $item->id)->delete();
            }

//            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }
}
