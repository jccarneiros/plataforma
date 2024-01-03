<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Room;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Administrations\UserRepository;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * ListStudentsComponents
 */
class ListStudentsComponents extends Component
{
    protected StudentsRepository $repository;
    private Request $request;
    private FlashMessage $message;

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
     * Get the view / contents that represent the component.
     */
    public function index(): View|Closure|string
    {
        $searchStudentRa = $this->request->input('searchStudentRa');

        $students = Student::with('room',  'tutoria')
            ->orWhere('name', 'LIKE', '%' . $searchStudentRa . '%')
            ->orWhere('number_ra', 'LIKE', '%' . $searchStudentRa . '%')
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc')
            ->paginate(12);
//        dd($students);

        $rooms = Room::with('students')->where('type', '=', 'Regular')->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')->orderBy('name', 'asc')->get();

        return view('components.students.list-students-components', compact('students', 'rooms'));
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

        return view('components.students.list-students-components', compact('students', 'rooms'));
    }

    /**
     * @return View
     */
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

    public function edit(int $id): View
    {
        $item = $this->repository::find($id);

        return view('components.students.edit', compact('item'));

    }

    public function updateAvatar(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        if ($this->request->avatar == '') {
            $this->message->selectAvatar();

            return redirect()->back();
        }

        if ($this->request->avatar !== null) {
            $nameImage = $item->number_ra . '-' .Str::slug($item->name, '-').'.'.explode(
                    '/',
                    explode(':', substr($this->request->avatar, 0, strpos($this->request->avatar, ';')))[1]
                )[1];

            Image::make($this->request->avatar)->resize(270, 200)->save(public_path('/assets/uploads/images/users/').$nameImage);
            $this->request->merge(['avatar' => $nameImage]);

            $itemImage = public_path('/assets/uploads/images/users/');
            if (file_exists($itemImage)) {
                @unlink($itemImage);
            }
        }

        $update = $this->repository::update($item->id, [
            'avatar' => $this->request['avatar'],
        ]);

        User::where('email', $item->email_google)->update([
            'avatar' => $this->request['avatar'],
        ]);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }
}
