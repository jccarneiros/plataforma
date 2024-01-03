<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Services\FlashMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\select;

/**
 *RelatorioController
 */
class RelatorioController extends Controller
{
    protected Request $request;
    protected FlashMessage $message;

    /**
     * @param Request $request
     * @param FlashMessage $message
     */
    public function __construct(Request $request, FlashMessage $message)
    {
        // Seta o limite de post do php
        set_time_limit(3600);
        $this->request = $request;
        $this->message = $message;
    }

    // Gera Qrcode de cada aluno
    public function gerarQrcodeAlunoPdf($number_ra)
    {
        $aluno = DB::table('alunos')->where('number_ra', '=', $number_ra)->first();

        $pdf = PDF::loadView('dashboard.relatorios.pdf-gerar-qrcode-aluno', compact('aluno'));

        return $pdf->setPaper('A4', 'portrait')->stream('Lista de QrCode da turma:'. $aluno->name);

    }


   // Gera Qrcode de todos os estudantes da turma
    public function gerarQrcodeRoomStudentsPdf($room)
    {
        $room = Room::with('students')->select('id', 'name')->where('id', '=',$room)->first();

        $students = $room->students->where('student_situation', 'Ativo');

        $pdf = PDF::loadView('dashboard.relatorios.pdf-gerar-qrcode-room-students', compact('room', 'students'));

        return $pdf->setPaper('A4', 'portrait')->stream('Lista de QrCode da turma:'. $room->name);

    }
}
