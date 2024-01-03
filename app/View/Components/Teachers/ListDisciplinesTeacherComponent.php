<?php

declare(strict_types=1);

namespace App\View\Components\Teachers;

use App\Models\Discipline;
use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Student;
use App\Repositories\Components\DisciplinesRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

/**
 * ListDisciplinesTeacherComponent
 */
class ListDisciplinesTeacherComponent extends Component
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
        $disciplines = DisciplinesRepository::
        listDisciplinesTeacher(['tipoEnsino', 'serie', 'room', 'user'], 'tipo_ensino_id', 'asc', 'serie_id', 'asc', 'room_id', 'asc', 'name', 'asc');

        return view('components.teachers.fechamentos.list-disciplines-teacher-component', compact('disciplines'));
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


        return view('components.teachers.fechamentos.fechamento-teacher-component', compact('room', 'students', 'discipline', 'fechamentos'));
    }
}
