<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\GetDataStudentUpdate;
use App\Models\Fechamento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * UpdateDataStudentFechamento
 */
class UpdateDataStudentFechamento
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(GetDataStudentUpdate $event): void
    {
        $student = $event->student;
        $student_situation = $event->student_situation;

        Fechamento::where('student_id', $student)->update(
            [
                'student_situation' => $student_situation,
            ]
        );
    }
}
