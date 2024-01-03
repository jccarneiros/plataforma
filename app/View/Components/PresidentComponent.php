<?php

namespace App\View\Components;

use App\Http\Requests\Administrations\PresidentsStoreFormRequest;
use App\Models\Sala;
use App\Models\Student;
use App\Models\President;
use App\Models\Clube;
use App\Models\User;
use App\Repositories\Components\PresidentsRepository;
use App\Services\FlashMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class PresidentComponent extends Component
{
    protected PresidentsRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(PresidentsRepository $repository, Request $request, FlashMessage $message)
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
        $presidents = President::with('sala', 'user', 'students')
            ->orderBy('sala_id', 'asc')->orderBy('user_id', 'asc')
            ->get();


        $users = User::whereDoesntHave('president')->where('role', '=', 'Aluno(a)')
            ->orderBy('role', 'asc')->orderBy('name', 'asc')->get();

        $salas = Sala::whereDoesntHave('president')->orderBy('name', 'asc')->get();


        return view('components.presidents.president-component', compact('presidents', 'salas','users'));
    }

    public function store(PresidentsStoreFormRequest $storeFormRequest): RedirectResponse
    {
//        dd($this->request->all());
        $store = $this->repository::create([
            'sala_id' => $storeFormRequest->input('sala_id'),
            'user_id' => $storeFormRequest->input('user_id'),
            'name_clube' => $storeFormRequest->input('name_clube'),
            'status_clube' => $storeFormRequest->input('status_clube'),
            'limit_clube_students' => $storeFormRequest->input('limit_clube_students'),
        ]);
        if ($store) {
//            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    public function clubes($id)
    {
        $president = President::with('sala','user','students')->where('id', '=', $id)->find($id);

        $salas = Sala::whereDoesntHave('president')->orderBy('name', 'asc')->get();

        $users = User::whereDoesntHave('president')->where('role', '=', 'Aluno(a)')
            ->orderBy('role', 'asc')->orderBy('name', 'asc')->get();

        $clubes = Clube::with('president', 'student')->where('president_id', '=', $president->id)->get();



        $students = Student::whereDoesntHave('clube')->with('room')
            ->where('type', 'Regular')->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc')->get();

        return view('components.presidents.clubes', compact('president', 'salas','users','students', 'clubes'));
    }

    public function storeStudentClubes(): RedirectResponse
    {
        $store = Clube::create([
            'president_id' => $this->request->input('president_id'),
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

    public function updateStatusPresident($id)
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'status_clube' => $this->request->input('status_clube'),
        ]);

        if ($update) {
//            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function updateLimitPresident($id)
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'limit_clube_students' => $this->request->input('limit_clube_students'),
        ]);

        if ($update) {
//            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function studentsClubePdf($id)
    {

        $president = President::where('id', $id)->first();

        $clubes = Clube::with('student')->where('president_id', '=', $id)->orderBy('created_at', 'asc')->get();

//        dd($clubes);
        $pdf = PDF::loadView('components.presidents.pdf-president-students', compact('president', 'clubes'));

        return $pdf->setPaper('A4')->stream('Lista de alunos tutorados');
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
            DB::table('clubes')->where('president_id', '=', $item->id)->delete();
//            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }
}
