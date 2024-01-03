<?php
declare(strict_types=1);

namespace App\Http\Controllers\PainelStudents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\SelectTutorFormRequest;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\Tutoria;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Illuminate\Http\Request;

/**
 *TutoriaController
 */
class TutoriaController extends Controller
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

    public function index($code)
    {
        $tutors = Tutor::with('user', 'sala')->where('status_tutoria', '=', 1)->get();

        $student = Student::with('tutoria')->where('email_google', '=', auth()->user()->email)->first();

        return view('students.tutorias.index', compact('tutors', 'student'));

    }

    public function selectTutor(SelectTutorFormRequest $tutorFormRequest,$code)
    {
        $store = Tutoria::create([
            'tutor_id' => $tutorFormRequest->input('tutor_id'),
            'student_id' => $tutorFormRequest->input('student_id'),

        ]);
        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }
}
