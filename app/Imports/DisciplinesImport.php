<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Discipline;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

/**
 * DisciplinesImport
 */
class DisciplinesImport implements ToModel
{

    public function model(array $row)
    {
        // Verifica na tabela disciplines se existe um room_id e name igual ao da tabela do excel
        if (Discipline::where('tipo_ensino_id', '=', request()->input('tipo_ensino_id'))
            ->where('serie_id', '=', request()->input('serie_id'))
            ->where('room_id', '=', request()->input('room_id'))
            ->where('name', '=', $row[0])->exists()) {
//            // Se existir será atualizado na tabela students
//            Discipline::where('tipo_ensino_id', '=', request()->input('tipo_ensino_id'))
//                ->where('serie_id', '=', request()->input('serie_id'))
//                ->where('room_id', '=', request()->input('room_id'))
//                ->where('name', '!=', $row[0])
//                ->update(
//                    [
//                        'name' => mb_strtoupper($row[0], 'utf-8'),
//                    ]
//                );
        } else {
            // Se não exitir será criado um novo registro na tabela students
            Discipline::create(
                [
                    'tipo_ensino_id' => request()->input('tipo_ensino_id'),
                    'serie_id' => request()->input('serie_id'),
                    'room_id' => request()->input('room_id'),
                    'name' => nameCase($row[0]),
                    'a_p_p_b' => 0,
                    'a_d_p_b' => 0,
                    'a_p_s_b' => 0,
                    'a_d_s_b' => 0,
                    'a_p_t_b' => 0,
                    'a_d_t_b' => 0,
                    'a_p_q_b' => 0,
                    'a_d_q_b' => 0,
                    't_a_d_ano' => 0,
                ]
            );
        }
    }
}