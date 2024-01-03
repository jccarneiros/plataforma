<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\President;

/**
 * PresidentObserver
 */
class PresidentObserver
{
    /**
     * Handle the President "creating" event.
     */
    public function creating(President $president): void
    {
        $president->code = uniqid('', false);
    }

    /**
     * Handle the President "updating" event.
     */
    public function updating(President $president): void
    {
        //
    }

    /**
     * Handle the President "deleted" event.
     */
    public function deleted(President $president): void
    {
        //
    }

    /**
     * Handle the President "restored" event.
     */
    public function restored(President $president): void
    {
        //
    }

    /**
     * Handle the President "force deleted" event.
     */
    public function forceDeleted(President $president): void
    {
        //
    }
}
