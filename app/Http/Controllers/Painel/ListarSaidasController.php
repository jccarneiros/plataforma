<?php
declare(strict_types=1);

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\RegisterEntrancesStudent;
use App\Models\Student;
use App\Services\FlashMessage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *ListarSaidasController
 */
class ListarSaidasController extends Controller
{
    protected Request $request;
    protected FlashMessage $message;

    public function __construct(Request $request, FlashMessage $message)
    {
        $this->request = $request;
        $this->message = $message;
    }
    public function listarSaidas()
    {
        $rooms = DB::table('rooms')->where('type', '=', 'Regular')
            ->orderBy('tipo_ensino_id', 'asc')->orderBy('serie_id', 'asc')
            ->orderBy('name', 'asc')->get();

        return view('painel.estudantes.listar-saidas', compact('rooms'));
    }

    public function listarSaidasPorTurma($room)
    {
        $months = [
            'janeiro',
            'fevereiro',
            'março',
            'abril',
            'maio',
            'junho',
            'julho',
            'agosto',
            'setembro',
            'outubro',
            'novembro',
            'dezembro',
        ];

        // Retorna o valor do mês da url
        $segmentRoom = $this->request->segment(4);

        $segmentMonth = $this->request->segment(5);

        // Retorna os dados referente a $mes
        $students = Student::with('outputs')->where('student_situation', '=', 'Ativo')
            ->where('room_id', '=', $segmentRoom)->orderByRaw('(number - name) asc')
            ->orderBy('number', 'desc')->get();

        $outputsMonths = RegisterEntrancesStudent::select('month_name', 'month_start', 'month_end')
            ->where('room_id', '=', $segmentRoom)->where('month_name', '=', $segmentMonth)->first();

        // Verifica se existe os registros na tabela register_outputs_students
        if (isset($outputsMonths->month_start) && isset($outputsMonths->month_end)) {
            // Se existir os registros, retorna os campos month_start e month_end da tabela register_outputs_students
            $period = CarbonPeriod::create($outputsMonths->month_start, $outputsMonths->month_end);
            // Converte a $period em array de dias
            $dates = $period->toArray();
        } else {
            // Se não existir os registros, retorna o período do mês atual
            $period = CarbonPeriod::create(
                Carbon::now()->startOfMonth()->format('Y-m-d'),
                Carbon::now()->endOfMonth()->format('Y-m-d')
            );
            // Converte a $period em array de dias
            $dates = $period->toArray();
        }

        $rooms = DB::table('register_outputs_students')->select('room_id')->groupBy('room_id')->get();

        return view('painel.estudantes.listar-saidas-por-turma',
            compact('dates', 'students', 'months', 'rooms', 'segmentRoom', 'segmentMonth')
        );
    }

    public function filtrarSaidasEstudantesPorTurma()
    {
        $months = [
            'janeiro',
            'fevereiro',
            'março',
            'abril',
            'maio',
            'junho',
            'julho',
            'agosto',
            'setembro',
            'outubro',
            'novembro',
            'dezembro',
        ];

        // Retorna o valor do mês da url
        $segmentRoom = $this->request->segment(4);

        $segmentMonth = $this->request->segment(5);
        // Verifica se existe os registros na tabela register_outputs_students
        if (isset($outputsMonths->month_start) && isset($outputsMonths->month_end)) {
            // Se existir os registros, retorna os campos month_start e month_end da tabela register_outputs_students
            $period = CarbonPeriod::create($outputsMonths->month_start, $outputsMonths->month_end);
            // Converte a $period em array de dias
            $dates = $period->toArray();
        } else {
            // Se não existir os registros, retorna o período do mês atual
            $period = CarbonPeriod::create(
                Carbon::now()->startOfMonth()->format('Y-m-d'),
                Carbon::now()->endOfMonth()->format('Y-m-d')
            );
            // Converte a $period em array de dias
            $dates = $period->toArray();
        }

        // Retorna os dados referente a $mes
        $students = Student::with('outputs')->where('student_situation', '=', 'Ativo')
            ->where('room_id', '=', $segmentRoom)->orderByRaw('(number - name) asc')
            ->orderBy('number', 'desc')->get();

        return view('painel.estudantes.listar-saidas-por-turma', compact('months', 'segmentRoom', 'segmentMonth', 'dates', 'students'));
    }
}
