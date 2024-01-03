<?php

namespace App\View\Components;

use App\Http\Requests\Administrations\SelectTutorFormRequest;
use App\Models\Sala;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\Tutoria;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class StudentTutoria extends Component
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
    public function render(): View|Closure|string
    {

        $tutors = Tutor::with('user', 'sala')->where('status_tutoria', '=', 1)->get();

        $student = Student::with('tutoria')->where('email_google', '=', auth()->user()->email)->first();

        return view('components.students.student-tutoria', compact('tutors', 'student'));
    }

    public function selectTutor(SelectTutorFormRequest $tutorFormRequest)
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
