<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\StudentsUpdateFormRequest;
use App\Models\Room;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 *ListStudentController
 */
class ListStudentController extends Controller
{
    protected StudentsRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(StudentsRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * @return View
     */
    public function index(): View
    {

        $searchStudentRa = $this->request->input('searchStudentRa');

        $students = Student::with('room',  'tutoria')
            ->orWhere('name', 'LIKE', '%' . $searchStudentRa . '%')
            ->orWhere('number_ra', 'LIKE', '%' . $searchStudentRa . '%')
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc')
            ->paginate(12);

        $rooms = Room::with('students')->where('type', '=', 'Regular')->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')->orderBy('name', 'asc')->get();

        return view('dashboard.students.list-students', compact('students', 'rooms'));
    }

    /**
     * @param $room
     * @return View
     */
    public function filterStudentRoom($room): View
    {
        $students = Student::with(['tipoEnsino', 'serie', 'room'])->where('room_id', 'LIKE', $room)
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc')
            ->paginate(100);
        $rooms = Room::with('students')->where('type', '=', 'Regular')->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')->orderBy('name', 'asc')->get();

        return view('dashboard.students.list-students', compact('students', 'rooms'));
    }

//    /**
//     * @return View
//     */
//    public function filterStudentRa(): View
//    {
//        $searchStudentRa = $this->request->input('searchStudentRa');
//
//        $students = Student::with('room')
//            ->orWhere('name', 'LIKE', '%' . $searchStudentRa . '%')
//            ->orWhere('number_ra', 'LIKE', '%' . $searchStudentRa . '%')
//            ->orderBy('room_id', 'asc')
//            ->orderByRaw('(room_id - number) desc')
//            ->orderBy('number', 'asc')
//            ->paginate(12);
//
//        $rooms = Room::with('students')->where('type', '=', 'Regular')->orderBy('tipo_ensino_id', 'asc')
//            ->orderBy('serie_id', 'asc')->orderBy('name', 'asc')->get();
//
//        return view('components.students.list-students-components', compact('students', 'rooms'));
//    }

//    public function update(StudentsUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
//    {
//        $item = $this->repository::find($id);
//
//        $update = $this->repository::update($item->id, [
//            'name' => $updateFormRequest->input('name'),
//            'number' => $updateFormRequest->input('number'),
//            'number_ra' => $updateFormRequest->input('number_ra'),
//            'number_ra_digit' => $updateFormRequest->input('number_ra_digit'),
//            'uf_ra' => $updateFormRequest->input('uf_ra'),
//            'date_birth' => $updateFormRequest->input('date_birth'),
//            'email_microsoft' => '0000' . $updateFormRequest->input('number_ra') .
//                $updateFormRequest->input('number_ra_digit') . 'sp@aluno.educacao.sp.gov.br',
//            'email_google' => '0000' . $updateFormRequest->input('number_ra') .
//                $updateFormRequest->input('number_ra_digit') . 'sp@al.educacao.sp.gov.br',
//            'student_situation' => $updateFormRequest->input('student_situation'),
//            'type' => $updateFormRequest->input('type'),
//            'slug' => Str::slug($updateFormRequest->input('name')),
//        ]);
//
//        if ($update) {
//            $this->message->updateSuccess();
//
//        } else {
//            $this->message->updateError();
//
//        }
//
//        return redirect()->back();
//
//    }
}
