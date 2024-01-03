<?php

declare(strict_types=1);

namespace App\View\Components\Teachers;

use App\Events\GetDataDisciplineAulasDadasTeacherEvent;
use App\Models\Discipline;
use App\Models\Fechamento;
use App\Repositories\Components\FechamentosRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * FechamentoTeacherComponent
 */
class FechamentoTeacherComponent extends Component
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
    public function render(): View|Closure|string
    {
        return view('components.teachers.fechamentos.fechamento-teacher-component');
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

    public function updateFechamentoStudentsPrimeiroBimestre()
    {
        foreach ($this->request->id as $item => $value) {
            $totalFaltasBimestres = $this->request->f_p_b[$item];
            $totalFaltasCompensadasBimestres = $this->request->f_c_p_b[$item];
            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],

                'n_p_b' => $this->request->n_p_b[$item],
                'f_p_b' => $this->request->f_p_b[$item],
                'f_c_p_b' => $this->request->f_c_p_b[$item],
                't_f_bs' => $totalFaltasBimestres,
                't_f_comp' => $totalFaltasCompensadasBimestres,

                't_f_ano' => ($totalFaltasBimestres) - $totalFaltasCompensadasBimestres,
                't_a_d_ano' => $this->request->t_a_d_ano[$item],
                // Retorna a porcentagem que o aluno faltou
                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
                // Retorna a porcentagem que o aluno frequentou
                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
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

    public function updateFechamentoStudentsSegundoBimestre()
    {
        foreach ($this->request->id as $item => $value) {
            $totalFaltasBimestres = $this->request->f_s_b[$item];
            $totalFaltasCompensadasBimestres = $this->request->f_c_s_b[$item];
            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],

                'n_s_b' => $this->request->n_s_b[$item],
                'f_s_b' => $this->request->f_s_b[$item],
                'f_c_s_b' => $this->request->f_c_s_b[$item],
                't_f_bs' => $totalFaltasBimestres,
                't_f_comp' => $totalFaltasCompensadasBimestres,

                't_f_ano' => ($totalFaltasBimestres) - $totalFaltasCompensadasBimestres,
                't_a_d_ano' => $this->request->t_a_d_ano[$item],
                // Retorna a porcentagem que o aluno faltou
                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
                // Retorna a porcentagem que o aluno frequentou
                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
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

                'n_t_b' => $this->request->n_t_b[$item],
                'f_t_b' => $this->request->f_t_b[$item],
                'f_c_t_b' => $this->request->f_c_t_b[$item],
                't_f_bs' => $totalFaltasBimestres,
                't_f_comp' => $totalFaltasCompensadasBimestres,

                't_f_ano' => ($totalFaltasBimestres) - $totalFaltasCompensadasBimestres,
                't_a_d_ano' => $this->request->t_a_d_ano[$item],
                // Retorna a porcentagem que o aluno faltou
                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
                // Retorna a porcentagem que o aluno frequentou
                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
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
            $totalFaltasBimestres = $this->request->f_q_b[$item];
            $totalFaltasCompensadasBimestres = $this->request->f_c_q_b[$item];
            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],

                'n_q_b' => $this->request->n_q_b[$item],
                'f_q_b' => $this->request->f_q_b[$item],
                'f_c_q_b' => $this->request->f_c_q_b[$item],
                't_f_bs' => $totalFaltasBimestres,
                't_f_comp' => $totalFaltasCompensadasBimestres,

                't_f_ano' => ($totalFaltasBimestres) - $totalFaltasCompensadasBimestres,
                't_a_d_ano' => $this->request->t_a_d_ano[$item],
                // Retorna a porcentagem que o aluno faltou
                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
                // Retorna a porcentagem que o aluno frequentou
                //                't_f_porcentagem_ano' => ((100 - $totalFaltasBimestres) / $this->request->t_a_d_ano[$item]) * 100,
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

    public function updateFechamentoStudents($id)
    {
//        dd($this->request->all());

        foreach ($this->request->id as $item => $value) {
            $totalFaltasBimestres = $this->request->f_p_b[$item] + $this->request->f_s_b[$item] + $this->request->f_t_b[$item] + $this->request->f_q_b[$item];
            $totalFaltasCompensadasBimestres = $this->request->f_c_p_b[$item] + $this->request->f_c_s_b[$item] + $this->request->f_c_t_b[$item] + $this->request->f_c_q_b[$item];

            $dataUpdate = [
                'discipline_id' => $this->request->discipline_id[$item],
                'student_id' => $this->request->student_id[$item],

                'n_p_b' => $this->request->n_p_b[$item],
                'f_p_b' => $this->request->f_p_b[$item],
                'f_c_p_b' => $this->request->f_c_p_b[$item],
                'a_p_p_b' => $this->request->a_p_p_b[$item],
                'a_d_p_b' => $this->request->a_d_p_b[$item],

                'n_s_b' => $this->request->n_s_b[$item],
                'f_s_b' => $this->request->f_s_b[$item],
                'f_c_s_b' => $this->request->f_c_s_b[$item],
                'a_p_s_b' => $this->request->a_p_s_b[$item],
                'a_d_s_b' => $this->request->a_d_s_b[$item],

                'n_t_b' => $this->request->n_t_b[$item],
                'f_t_b' => $this->request->f_t_b[$item],
                'f_c_t_b' => $this->request->f_c_t_b[$item],
                'a_p_t_b' => $this->request->a_p_t_b[$item],
                'a_d_t_b' => $this->request->a_d_t_b[$item],

                'n_q_b' => $this->request->n_q_b[$item],
                'f_q_b' => $this->request->f_q_b[$item],
                'f_c_q_b' => $this->request->f_c_q_b[$item],
                'a_p_q_b' => $this->request->a_p_q_b[$item],
                'a_d_q_b' => $this->request->a_d_q_b[$item],

                'n_q_c' => $this->request->n_q_c[$item],
                't_f_bs' => $totalFaltasBimestres,
                't_f_comp' => $totalFaltasCompensadasBimestres,

                't_f_ano' => $totalFaltasBimestres - $totalFaltasCompensadasBimestres,
                't_a_d_ano' => $this->request->t_a_d_ano[$item],
                // Retorna a porcentagem que o aluno faltou
                't_f_porcentagem_ano' => (($totalFaltasBimestres - $totalFaltasCompensadasBimestres) / $this->request->t_a_d_ano[$item]) * 100,

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
}
