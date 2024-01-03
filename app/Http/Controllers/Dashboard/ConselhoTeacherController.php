<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Student;
use App\Repositories\Components\RoomsRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 *ConselhoTeacherController
 */
class ConselhoTeacherController extends Controller
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
    public function index(): View
    {
        $rooms = Room::with('tipoEnsino', 'serie', 'students', 'fechamentos')->where('type', '=', 'Regular')->get();

        return view('dashboard.teachers.conselho.conselho-rooms-teacher', compact('rooms'));
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

        return view('dashboard.teachers.conselho.conselho-room-teacher', compact('fechamentos',
            'room', 'search', 'item', 'result'));
    }
}
