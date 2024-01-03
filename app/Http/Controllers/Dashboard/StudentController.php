<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Events\GetDataStudentUpdate;
use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\StudentsStoreFormRequest;
use App\Http\Requests\Administrations\StudentsUpdateFormRequest;
use App\Imports\StudentsImport;
use App\Models\Aluno;
use App\Models\Discipline;
use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Components\StudentsRepository;
use App\Services\FlashMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

//use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 *StudentController
 */
class StudentController extends Controller
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
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.students.index');
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
            'room_id' => $storeFormRequest->input('room_id'),
            'name' => nameCase($storeFormRequest->input('name')),
            'number' => $storeFormRequest->input('number'),
            'number_ra' => $storeFormRequest->input('number_ra'),
            'number_ra_digit' => $storeFormRequest->input('number_ra_digit'),
            'uf_ra' => $storeFormRequest->input('uf_ra'),
            'date_birth' => $storeFormRequest->input('date_birth'),
            'email_microsoft' => '0000' . $storeFormRequest->input('number_ra') .
                $storeFormRequest->input('number_ra_digit') . 'sp@aluno.educacao.sp.gov.br',
            'email_google' => '0000' . $storeFormRequest->input('number_ra') .
                $storeFormRequest->input('number_ra_digit') . 'sp@al.educacao.sp.gov.br',
            'student_situation' => $storeFormRequest->input('student_situation'),
            'type' => $storeFormRequest->input('type'),
            'slug' => Str::slug($storeFormRequest->input('name')),
        ]);
        if ($store) {
            $url = "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/{$this->request->input('number_ra')}";

            Storage::disk('local')->put('/public/images/qrcodes/' . $this->request->input('number_ra') . '.png', file_get_contents($url));

            $fileName = $this->request->input('number_ra') . '.png';

            $aluno = DB::table('alunos')->select('number_ra')->where('number_ra', '=', $this->request->input('number_ra'))->exists();
            if ($aluno === false) {
                Aluno::create([
                    'name' => nameCase($storeFormRequest->input('name')),
                    'number_ra' => $storeFormRequest->input('number_ra'),
                    'number_ra_digit' => $storeFormRequest->input('number_ra_digit'),
                    'uf_ra' => $storeFormRequest->input('uf_ra'),
                    'date_birth' => $storeFormRequest->input('date_birth'),
                    'email_microsoft' => '0000' . $storeFormRequest->input('number_ra') .
                        $storeFormRequest->input('number_ra_digit') . 'sp@aluno.educacao.sp.gov.br',
                    'email_google' => '0000' . $storeFormRequest->input('number_ra') .
                        $storeFormRequest->input('number_ra_digit') . 'sp@al.educacao.sp.gov.br',
                    'student_situation' => $storeFormRequest->input('student_situation'),
                    'qrcode' => $fileName
                ]);
                $roomName = DB::table('rooms')->select('id', 'name')->where('id', '=', $this->request->input('room_id'))->first();

                // Cria um novo arquivo na turma no Google Drive
                Storage::disk('google')->putFileAs("ArquivosPlataforma/QrCodes/$roomName->name", $url, $fileName);
            }

            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    public function edit(int $id): View
    {
        $item = $this->repository::find($id);

        return view('dashboard.students.edit', compact('item'));

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
            'name' => nameCase($updateFormRequest->input('name')),
            'number' => $updateFormRequest->input('number'),
            'number_ra' => $updateFormRequest->input('number_ra'),
            'number_ra_digit' => $updateFormRequest->input('number_ra_digit'),
            'uf_ra' => $updateFormRequest->input('uf_ra'),
            'date_birth' => $updateFormRequest->input('date_birth'),
            'email_microsoft' => '0000' . $updateFormRequest->input('number_ra') .
                $updateFormRequest->input('number_ra_digit') . 'sp@aluno.educacao.sp.gov.br',
            'email_google' => '0000' . $updateFormRequest->input('number_ra') .
                $updateFormRequest->input('number_ra_digit') . 'sp@al.educacao.sp.gov.br',
            'student_situation' => $updateFormRequest->input('student_situation'),
            'type' => $updateFormRequest->input('type'),
            'slug' => Str::slug($updateFormRequest->input('name')),
        ]);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    public function updateAvatar(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        if ($this->request->avatar == '') {
            $this->message->selectAvatar();

            return redirect()->back();
        }

        if ($this->request->avatar !== null) {
            $nameImage = $item->number_ra . '-' . Str::slug($item->name, '-') . '.' . explode(
                    '/',
                    explode(':', substr($this->request->avatar, 0, strpos($this->request->avatar, ';')))[1]
                )[1];

            Image::make($this->request->avatar)->resize(270, 200)->save(public_path('/assets/uploads/images/users/') . $nameImage);
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

    public function export(int $id)
    {
        $room = Room::find($id);

        return Excel::download(new StudentsExport($room->id), $room->name . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }

//    public function ramanejamento(int $id): RedirectResponse
//    {
//
//        $item = $this->repository::find($id);
//
//        $update = $this->repository::update($item->id, [
//            'tipo_ensino_id' => $this->request->tipo_ensino_id,
//            'serie_id' => $this->request->serie_id,
//            'room_id' => $this->request->room_id,
//            'number' => $this->request->number,
//            '$student_situation' => $this->request->$student_situation,
//        ]);
//        GetDataStudentUpdate::dispatch(
//            $item->id,
//            $this->request->tipo_ensino_id,
//            $this->request->serie_id,
//            $this->request->room_id,
//            $this->request->student_situation,
//        );
//
//        if ($update) {
//            $this->message->updateSuccess();
//        } else {
//            $this->message->updateError();
//        }
//
//        return redirect()->back();
//
//    }
}
