<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\Sala;

/**
 * SalaObserver
 */
class SalaObserver
{
    /**
     * Handle the Sala "creating" event.
     */
    public function creating(Sala $sala): void
    {
        $sala->code = uniqid('', false);
    }

    /**
     * Handle the Sala "updating" event.
     */
    public function updating(Sala $sala): void
    {
        //
    }

    /**
     * Handle the Sala "deleted" event.
     */
    public function deleted(Sala $sala): void
    {
        //
    }

    /**
     * Handle the Sala "restored" event.
     */
    public function restored(Sala $sala): void
    {
        //
    }

    /**
     * Handle the Sala "force deleted" event.
     */
    public function forceDeleted(Sala $sala): void
    {
        //
    }
}
