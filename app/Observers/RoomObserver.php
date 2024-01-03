<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\Room;

/**
 * RoomObserver
 */
class RoomObserver
{
    /**
     * Handle the Room "creating" event.
     */
    public function creating(Room $room): void
    {
        $room->code = uniqid('', false);
    }

    /**
     * Handle the Room "updating" event.
     */
    public function updating(Room $room): void
    {
        //
    }

    /**
     * Handle the Room "deleted" event.
     */
    public function deleted(Room $room): void
    {
        //
    }

    /**
     * Handle the Room "restored" event.
     */
    public function restored(Room $room): void
    {
        //
    }

    /**
     * Handle the Room "force deleted" event.
     */
    public function forceDeleted(Room $room): void
    {
        //
    }
}
