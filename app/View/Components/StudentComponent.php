<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Events\GetDataStudentUpdate;
use App\Http\Requests\Administrations\StudentsStoreFormRequest;
use App\Http\Requests\Administrations\StudentsUpdateFormRequest;
use App\Imports\StudentsImport;
use App\Models\User;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class StudentComponent extends Component
{
    protected StudentsRepository $repository;

    protected Request $request;

    protected FlashMessage $message;

    public $data;

    public $item;

    public function __construct(StudentsRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return View|Htmlable|\Closure|string
     */
    public function render(): View
    {
        return view('components.students.student-component');
    }

    /**
     * @param StudentsStoreFormRequest $storeFormRequest
     * @return RedirectResponse
     */
    public function store(StudentsStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository::create([
            'tipo_ensino_id' => $storeFormRequest->input('tipo_ensino_id'),
            'serie_id' => $storeFormRequest->input('serie_id'),
            'name' => $storeFormRequest->input('name'),
            'number' => $storeFormRequest->input('number'),
            'number_ra' => $storeFormRequest->input('number_ra'),
            'number_ra_digit' => $storeFormRequest->input('number_ra_digit'),
            'uf_ra' => $storeFormRequest->input('uf_ra'),
            'date_birth' => $storeFormRequest->input('date_birth'),
            'email_microsoft' => $storeFormRequest->input('email_microsoft'),
            'email_google' => $storeFormRequest->input('email_google'),
            'student_situation' => $storeFormRequest->input('student_situation'),
        ]);
        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    /**
     * @param StudentsUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StudentsUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {

        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'name' => $updateFormRequest->input('name'),
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

        $delete = $this->repository::delete($item->id);

        if ($delete) {
            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function import(): RedirectResponse
    {
        $this->request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
            'tipo_ensino_id' => 'required',
            'serie_id' => 'required',
            'room_id' => 'required',
        ]);

        $import = Excel::import(new StudentsImport(), request()->file('select_file'));

        if ($import) {
            $this->message->importSuccess();
        } else {
            $this->message->importError();
        }

        return redirect()->back()->with('success', 'Registros importados com sucesso!');
    }

    public function ramanejamento(int $id): RedirectResponse
    {

        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'tipo_ensino_id' => $this->request->tipo_ensino_id,
            'serie_id' => $this->request->serie_id,
            'room_id' => $this->request->room_id,
            'number' => $this->request->number,
        ]);
        GetDataStudentUpdate::dispatch(
            $item->id,
            $this->request->tipo_ensino_id,
            $this->request->serie_id,
            $this->request->room_id,
        );

        if ($update) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }
}
