<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Imports\ImportPrimeiroBimestre;
use App\Imports\StudentsImport;
use App\Models\Discipline;
use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Student;
use App\Repositories\Components\DisciplinesRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

/**
 *DisciplinesTeacherController
 */
class DisciplinesTeacherController extends Controller
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
    public function index(): View
    {
        $disciplines = DisciplinesRepository::
        listDisciplinesTeacher(['tipoEnsino', 'serie', 'room', 'user'], 'tipo_ensino_id', 'asc', 'serie_id', 'asc', 'room_id', 'asc', 'name', 'asc');

        return view('dashboard.teachers.fechamentos.disciplines-teacher', compact('disciplines'));
    }

    public function export(int $id, int $discipline)
    {
        $room = Room::find($id);

        $disciplineId = Discipline::with('room')->find($discipline);

        $discipline = Discipline::with('user')->where('id', '=', $disciplineId->id)
            ->where('user_id', '=', $disciplineId->user->id)
            ->first();

        return Excel::download(new StudentsExport($room->id), $room->name . '-' . $discipline->name . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }

    public function fechamentos(string $room, int $id)
    {
        $discipline = Discipline::with('room')->find($id);

        $room = Room::with('students', 'disciplines', 'fechamentos')->where('code', '=', $room)->first();

        $students = Student::with('tipoEnsino', 'serie', 'room', 'fechamentos')
            ->where('room_id', '=', $room->id)->get();

        $fechamentos = Fechamento::select('fechamentos.*')
            ->join('students', 'students.id', '=', 'fechamentos.student_id')
            ->orderByRaw('(students.number - name) asc')
            ->orderBy('students.number', 'desc')
            ->where('discipline_id', '=', $discipline->id)->get();


        return view('dashboard.teachers.fechamentos.fechamento-teacher', compact('room', 'students', 'discipline', 'fechamentos'));
    }
}
