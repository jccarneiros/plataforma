<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\TipoEnsino;

/**
 * TipoEnsinoObserver
 */
class TipoEnsinoObserver
{
    /**
     * Handle the TipoEnsino "creating" event.
     */
    public function creating(TipoEnsino $tipoEnsino): void
    {
        $tipoEnsino->code = uniqid('', false);
    }

    /**
     * Handle the TipoEnsino "updating" event.
     */
    public function updating(TipoEnsino $tipoEnsino): void
    {
        //
    }

    /**
     * Handle the TipoEnsino "deleted" event.
     */
    public function deleted(TipoEnsino $tipoEnsino): void
    {
        //
    }

    /**
     * Handle the TipoEnsino "restored" event.
     */
    public function restored(TipoEnsino $tipoEnsino): void
    {
        //
    }

    /**
     * Handle the TipoEnsino "force deleted" event.
     */
    public function forceDeleted(TipoEnsino $tipoEnsino): void
    {
        //
    }
}
