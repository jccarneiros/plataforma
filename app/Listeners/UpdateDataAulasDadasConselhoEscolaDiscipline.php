<?php

namespace App\Listeners;

use App\Events\GetDataDisciplineAulasDadasConselhoEscolaEvent;
use App\Models\Discipline;

class UpdateDataAulasDadasConselhoEscolaDiscipline
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\GetDataDisciplineAulasDadasConselhoEscolaEvent  $event
     * @return void
     */
    public function handle(GetDataDisciplineAulasDadasConselhoEscolaEvent $event)
    {
        $discipline = $event->discipline;
        $a_d_p_b = $event->a_d_p_b;
        $a_d_s_b = $event->a_d_s_b;
        $a_d_t_b = $event->a_d_t_b;
        $a_d_q_b = $event->a_d_q_b;
        $t_a_d_ano = $event->t_a_d_ano;

        Discipline::where('id', $discipline)->update(
            [
                'a_d_p_b' => $a_d_p_b,
                'a_d_s_b' => $a_d_s_b,
                'a_d_t_b' => $a_d_t_b,
                'a_d_q_b' => $a_d_q_b,
                't_a_d_ano' => $t_a_d_ano,
                //                't_f_porcentagem_ano' => (($t_f_bs - $t_f_comp) / $t_a_d_ano) * 100,
            ]
        );
    }

}