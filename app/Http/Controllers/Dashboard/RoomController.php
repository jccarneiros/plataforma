<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Events\GetDataStudentUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\RoomsStoreFormRequest;
use App\Http\Requests\Administrations\RoomsUpdateFormRequest;
use App\Models\Room;
use App\Models\Serie;
use App\Models\Student;
use App\Models\TipoEnsino;
use App\Models\User;
use App\Repositories\Components\RoomsRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 *RoomController
 */
class RoomController extends Controller
{
    protected RoomsRepository $repository;

    protected Request $request;

    protected FlashMessage $message;

    /**
     * @param RoomsRepository $repository
     * @param Request $request
     * @param FlashMessage $message
     */
    public function __construct(RoomsRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;

    }

    /**
     * @param int $tipoEnsinoId
     * @param int $serieId
     * @return View
     */
    public function index(int $tipoEnsinoId, int $serieId): View
    {
        $tipoEnsino = DB::table('tipo_ensinos')->where('id', '=', $tipoEnsinoId)->find($tipoEnsinoId);

        $serie = DB::table('series')->where('id', '=', $serieId)->find($serieId);

        $arrayRoom = ['6º', '7º', '8º', '9º', '1º', '2º', '3º',];

        $data = RoomsRepository::getRooms(['tipoEnsino', 'serie', 'students'], $tipoEnsino->id, $serie->id, 'tipo_ensino_id', 'asc', 'serie_id', 'asc', 'name', 'asc');

        return view('dashboard.rooms.index', compact('data', 'tipoEnsino', 'serie', 'arrayRoom'));
    }

//    public function itinerarioSerie(int $tipoEnsinoId, int $serieId, int $room)
//    {
//        $tipoEnsino = DB::table('tipo_ensinos')->where('id', '=', $tipoEnsinoId)->find($tipoEnsinoId);
////        dd($tipoEnsino);
//
//        $serie = DB::table('series')->where('id', '=', $serieId)->find($serieId);
//
//        $listStudents = Student::with('tipoEnsino', 'serie', 'room')
//            ->where('tipo_ensino_id', '=', $tipoEnsino->id)
//            ->where('serie_id', '=', $serie->id)->get();
//
//        $room = Room::find($room);
//
//        return view('dashboard.rooms.students', compact('tipoEnsino', 'serieId', 'room', 'listStudents'));
//
//    }

    /**
     * @param RoomsStoreFormRequest $storeFormRequest
     * @return RedirectResponse
     */
    public function store(Request $storeFormRequest): RedirectResponse
    {

        if ($this->request->input('name') == '') {
            $store = $this->repository::create([
                'tipo_ensino_id' => $storeFormRequest->input('tipo_ensino_id'),
                'serie_id' => $storeFormRequest->input('serie_id'),
                'name' => $this->request->input('room') . $this->request->input('letter'),
                'type' => nameCase($storeFormRequest['type']),
                'slug' => Str::slug($storeFormRequest['name']),
            ]);
        } else {
            $store = $this->repository::create([
                'tipo_ensino_id' => $storeFormRequest->input('tipo_ensino_id'),
                'serie_id' => $storeFormRequest->input('serie_id'),
                'name' => $storeFormRequest['name'],
                'type' => nameCase($storeFormRequest['type']),
                'slug' => Str::slug($storeFormRequest['name']),
            ]);
        }

        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

//    public function itinerarioStudentStore(Request $request, int $tipoEnsinoId, int $serieId)
//    {
//        $student_id = $request->input('student_id');
//        $roomType = $request->input('type');
//
//        $student = Student::with('tipoEnsino','serie','room')->where('id', '=', $student_id)->first();
//
//        $store = Student::where('id', $student)->create([
//            'tipo_ensino_id' => $student->tipo_ensino_id,
//            'serie_id' => $student->serie_id,
//            'room_id' => $student->room_id,
//            'name' => $student->name,
//            'number' => $student->number,
//            'number_ra' => $student->number_ra,
//            'number_ra_digit' => $student->number_ra_digit,
//            'uf_ra' => $student->uf_ra,
//            'date_birth' => $student->date_birth,
//            'email_microsoft' => $student->email_microsoft ,
//            'email_google' => $student->email_google,
//            'student_situation' => $student->student_situation,
//            'type' => $roomType,
//            'slug' => Str::slug($student->name),
//        ]);
//        if ($store) {
//            $this->message->storeSuccess();
//        } else {
//            $this->message->storeError();
//        }
//
//        return redirect()->back();
//
//    }

    /**
     * @param RoomsUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(RoomsUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'name' => $updateFormRequest['name'],
            'type' => $updateFormRequest['type'],
        ]);

        if ($update) {
            $this->message->updateSuccess();

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

        $inactive = $this->repository::delete($item->id);

        if ($inactive) {
            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }

    /**
     * @param $room
     * @return View
     */
    public function students(int $tipoEnsinoId, int $serieId, int $room): View
    {
        $tipoEnsino = DB::table('tipo_ensinos')->where('id', '=', $tipoEnsinoId)->find($tipoEnsinoId);

        $serie = Serie::with('students')->where('id', '=', $serieId)->find($serieId);

        $room = Room::find($room);

        $tipoEnsinos = TipoEnsino::orderBy('name', 'asc')->get();
        $series = Serie::orderBy('tipo_ensino_id', 'asc')->orderBy('name', 'asc')->get();
        $rooms = Room::orderBy('tipo_ensino_id', 'asc')->orderBy('serie_id', 'asc')->orderBy('name', 'asc')->get();

//        $listStudents = Student::with('tipoEnsino', 'serie', 'room')
//            ->where('tipo_ensino_id', '=', $tipoEnsino->id)
//            ->where('serie_id', '=', $serie->id)->get();

//        dd($listStudents);

        return view('dashboard.rooms.students', compact('tipoEnsino', 'serie', 'room', 'tipoEnsinos', 'series', 'rooms'));
    }

    public function updateStudentSituation(int $room)
    {
        $room = Room::find($room);

        $student = $this->request->input('student_id');

        // Atualiza o campo student_situation na tabela students
        $update = Student::where('id', $student)->where('room_id', $room->id)->update([
            'student_situation' => $this->request->input('student_situation')
        ]);
        // Atualiza o campo student_situation na tabela fechamentos
        GetDataStudentUpdate::dispatch(
            $student,
            $this->request->student_situation,
        );

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();
    }
}
