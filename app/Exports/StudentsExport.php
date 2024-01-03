<?php
declare(strict_types=1);

namespace App\Exports;

use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

/**
 *StudentsExport
 */
class StudentsExport implements FromCollection
{
    protected $room_id_export;

    public function __construct($room_id_export)
    {
        $this->room_id_export = $room_id_export;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $students = Student::select('number', 'name')->where('room_id', $this->room_id_export)->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')
            ->orderBy('room_id', 'asc')
            ->orderByRaw('(room_id - number) desc')
            ->orderBy('number', 'asc')->get();

        return collect($students);
    }

// Caso queira a primeira linha da planilha com os dados abaixo
    public function headings(): array
    {
        return [
            'number',
            'name'
        ];
    }
}
