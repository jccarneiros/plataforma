<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\Discipline;

/**
 * DisciplineObserver
 */
class DisciplineObserver
{
    /**
     * Handle the Discipline "creating" event.
     */
    public function creating(Discipline $discipline): void
    {
        $discipline->code = uniqid('', false);
    }

    /**
     * Handle the Discipline "updating" event.
     */
    public function updating(Discipline $discipline): void
    {
        //
    }

    /**
     * Handle the Discipline "deleted" event.
     */
    public function deleted(Discipline $discipline): void
    {
        //
    }

    /**
     * Handle the Discipline "restored" event.
     */
    public function restored(Discipline $discipline): void
    {
        //
    }

    /**
     * Handle the Discipline "force deleted" event.
     */
    public function forceDeleted(Discipline $discipline): void
    {
        //
    }
}
