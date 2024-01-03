<?php

declare(strict_types=1);

namespace App\View\Components\Teachers;

use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Student;
use App\Repositories\Components\RoomsRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

/**
 * ConselhoTeacherComponent
 */
class ConselhoTeacherComponent extends Component
{
    protected RoomsRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(RoomsRepository $repository, Request $request, FlashMessage $message)
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
        $rooms = Room::with('tipoEnsino', 'serie', 'students', 'fechamentos')->where('type', '=', 'Regular')->get();

        return view('components.teachers.conselho.conselho-rooms-teacher-component', compact('rooms'));
    }



    public function room(int $id): View
    {
        $room = $this->repository::find($id);

        $search = $this->request->input('search');

        $item = Student::with('tipoEnsino','serie','room')->where('number_ra', '=', $search)->first();

        $fechamentos = Fechamento::with('student')
            ->where('room_id', '=', $room->id)
            ->where('number_ra', 'LIKE', $search)
            ->get();

        $result = Fechamento::with('student')->select('resultado_final_student')
            ->where('number_ra', 'LIKE', $search)->groupBy('resultado_final_student')->first();

        return view('components.teachers.conselho.conselho-room-teacher-component', compact('fechamentos',
            'room', 'search', 'item', 'result'));
    }
}
