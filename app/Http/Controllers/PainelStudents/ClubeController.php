<?php
declare(strict_types=1);

namespace App\Http\Controllers\PainelStudents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\SelectPresidentClubeFormRequest;
use App\Models\Clube;
use App\Models\President;
use App\Models\Student;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 *ClubeController
 */
class ClubeController extends Controller
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

        $presidents = President::with('user', 'sala')->where('status_clube', '=', 1)->get();

        $student = Student::with('clube')->where('email_google', '=', auth()->user()->email)->first();

        return view('students.clubes.index', compact('presidents', 'student'));
    }

    public function selectPresident(SelectPresidentClubeFormRequest $presidentFormRequest, $code)
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
