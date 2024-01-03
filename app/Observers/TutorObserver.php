<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\Tutor;

/**
 * TutorObserver
 */
class TutorObserver
{
    /**
     * Handle the Tutor "creating" event.
     */
    public function creating(Tutor $tutor): void
    {
        $tutor->code = uniqid('', false);
    }

    /**
     * Handle the Tutor "updating" event.
     */
    public function updating(Tutor $tutor): void
    {
        //
    }

    /**
     * Handle the Tutor "deleted" event.
     */
    public function deleted(Tutor $tutor): void
    {
        //
    }

    /**
     * Handle the Tutor "restored" event.
     */
    public function restored(Tutor $tutor): void
    {
        //
    }

    /**
     * Handle the Tutor "force deleted" event.
     */
    public function forceDeleted(Tutor $tutor): void
    {
        //
    }
}
