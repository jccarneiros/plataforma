<?php
declare(strict_types=1);

namespace App\Http\Controllers\PainelStudents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\SelectProfessorEletivaFormRequest;
use App\Models\Eletiva;
use App\Models\Professor;
use App\Models\Student;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 *EletivaController
 */
class EletivaController extends Controller
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
     * Get the view / contents that represent the component.
     */
    public function index($code): View
    {

        $professors = Professor::with('user', 'sala')->where('status_eletiva', '=', 1)->get();

        $student = Student::with('eletiva')->where('email_google', '=', auth()->user()->email)->first();

        return view('students.eletivas.index', compact('professors', 'student'));
    }

    public function selectProfessor(SelectProfessorEletivaFormRequest $presidentFormRequest, $code)
    {
        $store = Eletiva::create([
            'professor_id' => $presidentFormRequest->input('professor_id'),
            'student_id' => $presidentFormRequest->input('student_id'),

        ]);
        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }
}
