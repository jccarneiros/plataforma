<?php
declare(strict_types=1);

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\RegisterOutputsStudent;
use App\Models\Student;
use App\Models\TipoEnsino;
use App\Services\FlashMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 *RegistrarSaidaEstudantesController
 */
class RegistrarSaidaEstudantesController extends Controller
{
    protected Request $request;
    protected FlashMessage $message;

    public function __construct(Request $request, FlashMessage $message)
    {
        $this->request = $request;
        $this->message = $message;
    }

    public function registrarSaidaEstudantes($moth, $day)
    {
        $dayUpdate = Carbon::now('America/Sao_Paulo')->format('Y-m-d');

        $registersDay = RegisterOutputsStudent::with('tipoEnsino', 'serie', 'room', 'student')
            ->whereDate('updated_at', $dayUpdate)->get();

        $outputs = RegisterOutputsStudent::with('student')->select('student_id', 'updated_at')
            ->whereDate('updated_at', $dayUpdate)->orderByDesc('updated_at')->paginate(8);

        $tipoEnsinos = TipoEnsino::with('outputs')->where('type', '=', 'Regular')->get();

        return view('painel.estudantes.registrar-saidas', compact('outputs', 'registersDay', 'tipoEnsinos'));
    }

    public function registrarFilterEstudantesTipoEnsino($month, $day)
    {
        $dayUpdate = Carbon::now('America/Sao_Paulo')->format('Y-m-d');

        $registersDay = RegisterOutputsStudent::with('tipoEnsino', 'serie', 'room', 'student')
            ->whereDate('updated_at', $dayUpdate)->get();

        $tipoEnsinos = TipoEnsino::with('outputs')->where('type', '=', 'Regular')->get();

        $outputs = RegisterOutputsStudent::with('tipoEnsino', 'serie', 'room', 'student')
            ->select('student_id', 'updated_at', 'month_name')
            ->whereDate('updated_at', $dayUpdate)->orderByDesc('updated_at')->paginate(8);

        $filterTipoEnsino = $this->request->input('filterTipoEnsino');

        $registerTipoEnsinos = DB::table('register_outputs_students')
            ->where('tipo_ensino_id', 'LIKE', $filterTipoEnsino)
            ->whereDate('updated_at', $dayUpdate)
            ->count();

        return view('painel.estudantes.registrar-saidas',
            compact('outputs', 'registersDay', 'tipoEnsinos', 'registerTipoEnsinos', 'filterTipoEnsino'));
    }

    public function cadastrarSaidaEstudantes()
    {
        $raStudent = $this->request->segment(5);
        $columns = Schema::getColumnListing('register_outputs_students');

        $month = Carbon::now('America/Sao_Paulo')->monthName;
        $dayColumn = 'day_'. Carbon::now('America/Sao_Paulo')->day;

        $month_start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $month_end = Carbon::now()->endOfMonth()->format('Y-m-d');
        $output = DB::table('register_outputs_students')->where('ra_student', $raStudent)->where('month_name', $month)->first();

        if (in_array($dayColumn, $columns)) {
            $student = Student::with('tipoEnsino', 'serie', 'room')->where('number_ra', '=', $raStudent)
                ->where('type', '=', 'Regular')->where('student_situation', '=', 'Ativo')
                ->first();
            if (DB::table('register_outputs_students')->where('ra_student', '=', $raStudent)
                    ->where('month_name', '=', $month)->count() > 0) {

                DB::table('register_outputs_students')->where('id', '=', $output->id)
                    ->where('month_name', '=', $month)->where('ra_student', '=', $raStudent)
                    ->update([
                        'tipo_ensino_id' => $student->tipoEnsino->id,
                        'serie_id' => $student->serie->id,
                        'room_id' => $student->room->id,
                        $dayColumn => Carbon::now('America/Sao_Paulo')->format('H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                RegisterOutputsStudent::create([
                    'month_start' => $month_start,
                    'month_end' => $month_end,
                    'month_name' => $month,
                    'student_id' => $student->id,
                    'tipo_ensino_id' => $student->tipoEnsino->id,
                    'serie_id' => $student->serie->id,
                    'room_id' => $student->room->id,
                    'ra_student' => $student->number_ra,
                    $dayColumn => Carbon::now('America/Sao_Paulo')->format('H:i:s'),
                ]);
            }
//            $this->message->updateSuccess();
            return redirect()->back();
        }
    }
}
