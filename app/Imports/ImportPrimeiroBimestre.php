<?php

namespace App\Imports;

use App\Enums\SupportStatus;
use App\Models\Discipline;
use App\Models\Fechamento;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use RealRashid\SweetAlert\Facades\Alert;

/**
 *ImportPrimeiroBimestre
 */
class ImportPrimeiroBimestre implements ToModel
{
    private $discipline_id;

    public function __construct($discipline_id)
    {
        $this->discipline_id = $discipline_id;
    }

    public function model(array $row)
    {
        $discipline = Discipline::with('fechamentos')->select('id', 'user_id')
            ->where('id', '=', $this->discipline_id)->where('user_id', '=', auth()->user()->id)
            ->first();

        $exist = DB::table('fechamentos')->where('discipline_id', '=', $discipline->id)->exists();

        if ($exist) {
            foreach ($discipline->fechamentos as $fechamento) {
                Fechamento::where('id', $fechamento->id)
                    ->where('discipline_id', $this->discipline_id)
                    ->where('student_id', $fechamento->student->id)
                    ->where('number_ra', $fechamento->student->number_ra)
                    ->where('student_number', $row[0])
                    ->where('student_name', $row[1])
                    ->update([
                        'n_p_b' => str_replace('-', ' ', $row[2]),
                        'f_p_b' => str_replace('-', ' ', $row[3]),
                        'f_c_p_b' => str_replace('-', ' ', $row[4]),
                    ]);
            }
        } else {
            Alert::error('Erro!', 'Não foi possível importar os registros!')->timerProgressBar();
            return redirect()->back();
        }
    }
}
