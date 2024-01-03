<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\GetDataDisciplineAulasDadasTeacherEvent;
use App\Models\Fechamento;

class UpdateDataAulasDadasTeacherFechamento
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\GetDataDisciplineAulasDadasTeacherEvent  $event
     * @return void
     */
    public function handle(GetDataDisciplineAulasDadasTeacherEvent $event)
    {
        $discipline = $event->discipline;
        $a_p_p_b = $event->a_p_p_b;
        $a_d_p_b = $event->a_d_p_b;
        $a_p_s_b = $event->a_p_s_b;
        $a_d_s_b = $event->a_d_s_b;
        $a_p_t_b = $event->a_p_t_b;
        $a_d_t_b = $event->a_d_t_b;
        $a_p_q_b = $event->a_p_q_b;
        $a_d_q_b = $event->a_d_q_b;
        $t_a_d_ano = $event->t_a_d_ano;

        Fechamento::where('discipline_id', $discipline)->update(
            [
                'a_p_p_b' => $a_p_p_b,
                'a_d_p_b' => $a_d_p_b,
                'a_p_s_b' => $a_p_s_b,
                'a_d_s_b' => $a_d_s_b,
                'a_p_t_b' => $a_p_t_b,
                'a_d_t_b' => $a_d_t_b,
                'a_p_q_b' => $a_p_q_b,
                'a_d_q_b' => $a_d_q_b,
                't_a_d_ano' => $a_d_p_b + $a_d_s_b + $a_d_t_b + $a_d_q_b,
                //                't_f_porcentagem_ano' => (($t_f_bs - $t_f_comp) / $t_a_d_ano) * 100,
            ]
        );
    }

}