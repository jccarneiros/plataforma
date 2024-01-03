<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Events\GetDataDisciplineAulasDadasTeacherEvent;
use App\Http\Controllers\Controller;
use App\Imports\ImportPrimeiroBimestre;
use App\Imports\ImportQuartoBimestre;
use App\Imports\ImportQuintoConceito;
use App\Imports\ImportSegundoBimestre;
use App\Imports\ImportTerceiroBimestre;
use App\Models\Discipline;
use App\Models\Fechamento;
use App\Repositories\Components\FechamentosRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

/**
 *FechamentoTeacherController
 */
class FechamentoTeacherController extends Controller
{
    protected FechamentosRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(FechamentosRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function index(): View
    {
        return view('dashboard.teachers.fechamentos.fechamento-teacher');
    }

    public function updateAulasDiscipline($discipline_id)
    {
        if ($discipline_id) {
            $update = Discipline::where('id', $discipline_id)->update([
                'a_p_p_b' => $this->request->a_p_p_b,
                'a_d_p_b' => $this->request->a_d_p_b,
                'a_p_s_b' => $this->request->a_p_s_b,
                'a_d_s_b' => $this->request->a_d_s_b,
                'a_p_t_b' => $this->request->a_p_t_b,
                'a_d_t_b' => $this->request->a_d_t_b,
                'a_p_q_b' => $this->request->a_p_q_b,
                'a_d_q_b' => $this->request->a_d_q_b,
                't_a_d_ano' => (int)$this->request->a_d_p_b + (int)$this->request->a_d_s_b + (int)$this->request->a_d_t_b + (int)$this->request->a_d_q_b,
            ]);
            GetDataDisciplineAulasDadasTeacherEvent::dispatch(
                $discipline_id,
                $this->request->a_p_p_b,
                $this->request->a_d_p_b,
                $this->request->a_p_s_b,
                $this->request->a_d_s_b,
                $this->request->a_p_t_b,
                $this->request->a_d_t_b,
                $this->request->a_p_q_b,
                $this->request->a_d_q_b,
                $this->request->t_a_d_ano,
            );
            if ($update) {

                $this->message->updateSuccess();
            } else {
                $this->message->updateError();
            }

            return redirect()->back();
        }
    }


    public function importPrimeiroBimestre()
    {
        $discipline = $this->request->input('discipline_id');

        $this->request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
            'tipo_ensino_id' => 'required',
            'serie_id' => 'required',
            'room_id' => 'required',
        ]);

        $import = Excel::import(new ImportPrimeiroBimestre($discipline), request()->file('select_file'));

        if ($import) {
            $this->message->importSuccess();
        } else {
            $this->message->importError();
        }

        return redirect()->back()->with('success', 'Registros importados com sucesso!');
    }

    public function importSegundoBimestre(): RedirectResponse
    {
        $discipline = $this->request->input('discipline_id');

        $this->request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
            'tipo_ensino_id' => 'required',
            'serie_id' => 'required',
            'room_id' => 'required',
        ]);

        $import = Excel::import(new ImportSegundoBimestre($discipline), request()->file('select_file'));

        if ($import) {
            $this->message->importSuccess();
        } else {
            $this->message->importError();
        }

        return redirect()->back()->with('success', 'Registros importados com sucesso!');
    }

    public function importTerceiroBimestre(): RedirectResponse
    {
        $discipline = $this->request->input('discipline_id');

        $this->request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
            'tipo_ensino_id' => 'required',
            'serie_id' => 'required',
            'room_id' => 'required',
        ]);

        $import = Excel::import(new ImportTerceiroBimestre($discipline), request()->file('select_file'));

        if ($import) {
            $this->message->importSuccess();
        } else {
            $this->message->importError();
        }

        return redirect()->back()->with('success', 'Registros importados com sucesso!');
    }

    public function importQuartoBimestre(): RedirectResponse
    {
        $discipline = $this->request->input('discipline_id');

        $this->request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
            'tipo_ensino_id' => 'required',
            'serie_id' => 'required',
            'room_id' => 'required',
        ]);

        $import = Excel::import(new ImportQuartoBimestre($discipline), request()->file('select_file'));

        if ($import) {
            $this->message->importSuccess();
        } else {
            $this->message->importError();
        }

        return redirect()->back()->with('success', 'Registros importados com sucesso!');
    }

    public function importQuintoConceito(): RedirectResponse
    {
        $discipline = $this->request->input('discipline_id');

        $this->request->validate([
            'select_file' => 'required|max:10000|mimes:xlsx,xls',
            'tipo_ensino_id' => 'required',
            'serie_id' => 'required',
            'room_id' => 'required',
        ]);

        $import = Excel::import(new ImportQuintoConceito($discipline), request()->file('select_file'));

        if ($import) {
            $this->message->importSuccess();
        } else {
            $this->message->importError();
        }

        return redirect()->back()->with('success', 'Registros importados com sucesso!');
    }

    public function updateFechamentoStudentsPrimeiroBimestre()
    {
        foreach ($this->request->id as $item => $value) {
//            $totalFaltasBimestres = $this->request->f_p_b[$item];
//            $totalFaltasCompensadasBimestres = $this->request->f_c_p_b[$item];
            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],

                'n_p_b' => $this->request->n_p_b[$item],
                'f_p_b' => $this->request->f_p_b[$item],
                'f_c_p_b' => $this->request->f_c_p_b[$item],
                't_a_d_ano' => $this->request->t_a_d_ano[$item],

//                't_f_ano' => ($totalFaltasBimestres) - $totalFaltasCompensadasBimestres,
//                't_a_d_ano' => $this->request->t_a_d_ano[$item],
//                // Retorna a porcentagem que o aluno faltou
//                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
//                // Retorna a porcentagem que o aluno frequentou
//                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
            ];
//            dd($dataUpdate);
            $student = Fechamento::where('id', $this->request->id[$item])->update($dataUpdate);
        }
        if ($student) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }

    public function updateFechamentoStudentsSegundoBimestre()
    {
        foreach ($this->request->id as $item => $value) {
//            $totalFaltasBimestres = $this->request->f_s_b[$item];
//            $totalFaltasCompensadasBimestres = $this->request->f_c_s_b[$item];
            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],

                'n_p_b' => $this->request->n_p_b[$item],
                'f_p_b' => $this->request->f_p_b[$item],
                'f_c_p_b' => $this->request->f_c_p_b[$item],
                't_a_d_ano' => $this->request->t_a_d_ano[$item],

//                't_f_bs' => $this->request->f_s_b[$item],
//                't_f_comp' => $this->request->f_c_s_b[$item],
//                't_f_ano' => ($this->request->f_p_b[$item] + $this->request->f_s_b[$item]) - ($this->request->f_c_p_b[$item] + $this->request->f_c_s_b[$item]),
//                // Retorna a porcentagem que o aluno faltou
//                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
//                // Retorna a porcentagem que o aluno frequentou
//                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
            ];
            $student = Fechamento::where('id', $this->request->id[$item])->update($dataUpdate);
        }
        if ($student) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }

    public function updateFechamentoStudentsTerceiroBimestre()
    {
        foreach ($this->request->id as $item => $value) {
            $totalFaltasBimestres = $this->request->f_t_b[$item];
            $totalFaltasCompensadasBimestres = $this->request->f_c_t_b[$item];
            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],

                'n_p_b' => $this->request->n_p_b[$item],
                'f_p_b' => $this->request->f_p_b[$item],
                'f_c_p_b' => $this->request->f_c_p_b[$item],
                't_a_d_ano' => $this->request->t_a_d_ano[$item],

//                't_f_bs' => $this->request->f_t_b[$item],
//                't_f_comp' => $totalFaltasCompensadasBimestres,
//                't_f_ano' => ($totalFaltasBimestres) - $totalFaltasCompensadasBimestres,
//                // Retorna a porcentagem que o aluno faltou
//                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
//                // Retorna a porcentagem que o aluno frequentou
//                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
            ];
            $student = Fechamento::where('id', $this->request->id[$item])->update($dataUpdate);
        }
        if ($student) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }

    public function updateFechamentoStudentsQuartoBimestre()
    {
        foreach ($this->request->id as $item => $value) {
//            $totalFaltasBimestres = $this->request->f_q_b[$item];
//            $totalFaltasCompensadasBimestres = $this->request->f_c_q_b[$item];
            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],

                'n_p_b' => $this->request->n_p_b[$item],
                'f_p_b' => $this->request->f_p_b[$item],
                'f_c_p_b' => $this->request->f_c_p_b[$item],
                't_a_d_ano' => $this->request->t_a_d_ano[$item],

//                't_f_bs' => $totalFaltasBimestres,
//                't_f_comp' => $totalFaltasCompensadasBimestres,
//                't_f_ano' => ($totalFaltasBimestres) - $totalFaltasCompensadasBimestres,
//                // Retorna a porcentagem que o aluno faltou
//                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
//                // Retorna a porcentagem que o aluno frequentou
//                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
            ];
            $student = Fechamento::where('id', $this->request->id[$item])->update($dataUpdate);
        }
        if ($student) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }

    public function updateFechamentoStudentsQuintoConceito()
    {
        foreach ($this->request->id as $item => $value) {
            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],
                'n_q_c' => $this->request->n_q_c[$item],
            ];
            $student = Fechamento::where('id', $this->request->id[$item])->update($dataUpdate);
        }
        if ($student) {
            $this->message->updateSuccess();
        } else {
            $this->message->updateError();
        }

        return redirect()->back();

    }


    public function updateFechamentoStudents()
    {
//        dd($this->request->all());

        foreach ($this->request->id as $item => $value) {
//            dd($this->request->f_p_b);
            $totalFaltasBimestres = $this->request->f_p_b[$item] + $this->request->f_s_b[$item] + $this->request->f_t_b[$item] + $this->request->f_q_b[$item];
            $totalFaltasCompensadasBimestres = $this->request->f_c_p_b[$item] + $this->request->f_c_s_b[$item] + $this->request->f_c_t_b[$item] + $this->request->f_c_q_b[$item];

            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],
                't_f_ano' => ($totalFaltasBimestres) - $totalFaltasCompensadasBimestres,
                't_a_d_ano' => $this->request->t_a_d_ano[$item],

                't_f_bs' => $totalFaltasBimestres,
                't_f_comp' => $totalFaltasCompensadasBimestres,
                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,

//                'f_p_b' => $this->request->f_p_b[$item],
//                'f_c_p_b' => $this->request->f_c_p_b[$item],
//                'a_d_p_b' => $this->request->a_d_p_b[$item],
//
//                'f_s_b' => $this->request->f_s_b[$item],
//                'f_c_s_b' => $this->request->f_c_s_b[$item],
//                'a_d_s_b' => $this->request->a_d_s_b[$item],
//
//                'f_t_b' => $this->request->f_t_b[$item],
//                'f_c_t_b' => $this->request->f_c_t_b[$item],
//                'a_d_t_b' => $this->request->a_d_t_b[$item],
//
//                'f_q_b' => $this->request->f_q_b[$item],
//                'f_c_q_b' => $this->request->f_c_q_b[$item],
//                'a_d_q_b' => $this->request->a_d_q_b[$item],
//
//                'n_q_c' => $this->request->n_q_c[$item],
//                't_f_bs' => $this->request->f_p_b[$item] + $this->request->f_s_b[$item] + $this->request->f_t_b[$item] + $this->request->f_q_b[$item],

//                't_f_comp' => $this->request->f_c_p_b[$item] + $this->request->f_c_s_b[$item] + $this->request->f_c_t_b[$item] + $this->request->f_c_q_b[$item],

//                't_f_ano' => (($this->request->f_p_b[$item] + $this->request->f_s_b[$item] + $this->request->f_t_b[$item] + $this->request->f_q_b[$item]) -
//                    ($this->request->f_c_p_b[$item] + $this->request->f_c_s_b[$item] + $this->request->f_c_t_b[$item] + $this->request->f_c_q_b[$item])),


                // Retorna a porcentagem que o aluno faltou
//                't_f_porcentagem_ano' => (($this->request->f_p_b[$item] + $this->request->f_s_b[$item] + $this->request->f_t_b[$item] + $this->request->f_q_b[$item]) -
//                    ($this->request->f_c_p_b[$item] + $this->request->f_c_s_b[$item] + $this->request->f_c_t_b[$item] + $this->request->f_c_q_b[$item]) / $this->request->t_a_d_ano[$item] * 100)

                // Retorna a porcentagem que o aluno frequentou
                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
            ];

//            dd($dataUpdate);

            $student = Fechamento::where('id', $this->request->id[$item])->update($dataUpdate);
        }
        if ($student) {
            toast('Registros atualizados com sucesso!', 'success');

            return redirect()->back();
        } else {
            Alert::error('Erro!', 'Não foi possível atualizar os registros!');

            return redirect()->back();
        }
    }
}
