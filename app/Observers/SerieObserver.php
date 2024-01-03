<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\Serie;

/**
 * SerieObserver
 */
class SerieObserver
{
    /**
     * Handle the Serie "creating" event.
     */
    public function creating(Serie $serie): void
    {
        $serie->code = uniqid('', false);
    }

    /**
     * Handle the Serie "updating" event.
     */
    public function updating(Serie $serie): void
    {
        //
    }

    /**
     * Handle the Serie "deleted" event.
     */
    public function deleted(Serie $serie): void
    {
        //
    }

    /**
     * Handle the Serie "restored" event.
     */
    public function restored(Serie $serie): void
    {
        //
    }

    /**
     * Handle the Serie "force deleted" event.
     */
    public function forceDeleted(Serie $serie): void
    {
        //
    }
}
