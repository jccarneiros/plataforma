<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Events\GetDataDisciplineAulasDadasConselhoEscolaEvent;
use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Student;
use App\Repositories\Components\RoomsRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * ConselhoComponent
 */
class ConselhoComponent extends Component
{
    protected RoomsRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(RoomsRepository $repository, Request $request, FlashMessage $message)
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
        $rooms = Room::with('tipoEnsino', 'serie', 'students', 'fechamentos')->where('type', '=', 'Regular')->get();

        return view('components.conselhos.conselho-rooms-component', compact('rooms'));
    }


    public function room(int $id): View
    {
        $room = $this->repository::find($id);


        $search = $this->request->input('search');

        $item = Student::with('tipoEnsino', 'serie', 'room')
            ->where('number_ra', '=', $search)
            ->where('room_id', '=', $room->id)
            ->first();

        $fechamentos = Fechamento::with('tipoEnsino', 'serie', 'room', 'student')
            ->where('number_ra', 'LIKE', $search)
            ->get();

        $result = Fechamento::with('student')->select('resultado_final_student')
            ->where('number_ra', 'LIKE', $search)->groupBy('resultado_final_student')->first();

        return view('components.conselhos.conselho-room-component', compact('fechamentos',
            'room', 'search', 'item', 'result'));
    }

    public function updateStatusPrimeiroBimestreRoom(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $this->repository::update($item->id, [
            'status_p_b' => $this->request['status_p_b'],
        ]);

        return redirect()->back();

    }

    public function updateStatusSegundoBimestreRoom(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $this->repository::update($item->id, [
            'status_s_b' => $this->request['status_s_b'],
        ]);

        return redirect()->back();

    }

    public function updateStatusTerceiroBimestreRoom(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $this->repository::update($item->id, [
            'status_t_b' => $this->request['status_t_b'],
        ]);

        return redirect()->back();

    }

    public function updateStatusQuartoBimestreRoom(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $this->repository::update($item->id, [
            'status_q_b' => $this->request['status_q_b'],
        ]);

        return redirect()->back();

    }

    public function updateStatusQuintoConceitoRoom(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $this->repository::update($item->id, [
            'status_q_c' => $this->request['status_q_c'],
        ]);

        return redirect()->back();
    }

    public function conselhoUpdateResult(Request $request)
    {
        foreach ($request->id as $item => $value) {
            $student = Fechamento::where('id', $request->id[$item])->update(
                [
                    'resultado_final_student' => $request->resultado_final_student,
                ]
            );
        }
        if ($student) {
            $this->message->updateSuccess();

            return redirect()->back();
        } else {
            $this->message->updateError();

            return redirect()->back();
        }
    }


    public function conselhoUpdateStudent(Request $request)
    {
        if (array_search(0, $request->t_a_d_ano) !== 1) {
            foreach ($request->id as $item => $value) {
                $totalFaltasBimestres = $request->f_p_b[$item] + $request->f_s_b[$item] + $request->f_t_b[$item] + $request->f_q_b[$item];
                $totalFaltasCompensadasBimestres = $request->f_c_p_b[$item] + $request->f_c_s_b[$item] + $request->f_c_t_b[$item] + $request->f_c_q_b[$item];
                $dataUpdate = [
                    'n_p_b' => $request->n_p_b[$item],
                    'f_p_b' => $request->f_p_b[$item],
                    'f_c_p_b' => $request->f_c_p_b[$item],
                    'a_d_p_b' => $request->a_d_p_b[$item],
                    'n_s_b' => $request->n_s_b[$item],
                    'f_s_b' => $request->f_s_b[$item],
                    'f_c_s_b' => $request->f_c_s_b[$item],
                    'a_d_s_b' => $request->a_d_s_b[$item],
                    'n_t_b' => $request->n_t_b[$item],
                    'f_t_b' => $request->f_t_b[$item],
                    'f_c_t_b' => $request->f_c_t_b[$item],
                    'a_d_t_b' => $request->a_d_t_b[$item],
                    'n_q_b' => $request->n_q_b[$item],
                    'f_q_b' => $request->f_q_b[$item],
                    'f_c_q_b' => $request->f_c_q_b[$item],
                    'a_d_q_b' => $request->a_d_q_b[$item],
                    'n_q_c' => $request->n_q_c[$item],
                    't_f_bs' => $request->f_p_b[$item] + $request->f_s_b[$item] + $request->f_t_b[$item] + $request->f_q_b[$item],
                    't_f_comp' => $request->f_c_p_b[$item] + $request->f_c_s_b[$item] + $request->f_c_t_b[$item] + $request->f_c_q_b[$item],
                    't_a_d_ano' => $request->a_d_p_b[$item] + $request->a_d_s_b[$item] + $request->a_d_t_b[$item] + $request->a_d_q_b[$item],
                    't_f_ano' => $request->f_p_b[$item] + $request->f_s_b[$item] + $request->f_t_b[$item] + $request->f_q_b[$item],
                    't_f_porcentagem_ano' => (($request->t_f_bs[$item] - $request->t_f_comp[$item]) / $request->t_a_d_ano[$item]) * 100,
                    'resultado_final_student' => $request->resultado_final_student,
                ];

                $student = Fechamento::where('id', $request->id[$item])->update($dataUpdate);

                // Dispatching Event
                if ($student == true) {
                    event(
                        new GetDataDisciplineAulasDadasConselhoEscolaEvent(
                            $request->discipline_id[$item],
                            $request->a_d_p_b[$item],
                            $request->a_d_s_b[$item],
                            $request->a_d_t_b[$item],
                            $request->a_d_q_b[$item],
                            $request->t_a_d_ano[$item],
                        )
                    );
                }
            }
            if ($student) {
                $this->message->updateSuccess();

                return redirect()->back();
            } else {
                $this->message->updateError();

                return redirect()->back();
            }
        } else {
            Alert::error('Atenção!', 'O total de aulas dadas no ano não pode ser 0 ou nulo!');

            return redirect()->back();
        }
    }
}
