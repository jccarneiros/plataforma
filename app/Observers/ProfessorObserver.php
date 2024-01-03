<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\Professor;

/**
 * ProfessorObserver
 */
class ProfessorObserver
{
    /**
     * Handle the Professor "creating" event.
     */
    public function creating(Professor $professor): void
    {
        $professor->code = uniqid('', false);
    }

    /**
     * Handle the Professor "updating" event.
     */
    public function updating(Professor $professor): void
    {
        //
    }

    /**
     * Handle the Professor "deleted" event.
     */
    public function deleted(Professor $professor): void
    {
        //
    }

    /**
     * Handle the Professor "restored" event.
     */
    public function restored(Professor $professor): void
    {
        //
    }

    /**
     * Handle the Professor "force deleted" event.
     */
    public function forceDeleted(Professor $professor): void
    {
        //
    }
}
