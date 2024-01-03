<?php

namespace App\View\Components;

use App\Http\Requests\Administrations\SelectPresidentClubeFormRequest;
use App\Models\President;
use App\Models\Sala;
use App\Models\Student;
use App\Models\Clube;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class StudentClube extends Component
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

        $presidents = President::with('user', 'sala')->where('status_clube', '=', 1)->get();

        $student = Student::with('clube')->where('email_google', '=', auth()->user()->email)->first();

        return view('components.students.student-clube', compact('presidents', 'student'));
    }

    public function selectPresident(SelectPresidentClubeFormRequest $presidentFormRequest)
    {
        $store = Clube::create([
            'president_id' => $presidentFormRequest->input('president_id'),
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
