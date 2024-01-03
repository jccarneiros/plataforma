<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\Student;

/**
 * StudentObserver
 */
class StudentObserver
{
    /**
     * Handle the Student "creating" event.
     */
    public function creating(Student $student): void
    {
        $student->active = 1;
        $student->code = uniqid('', false);
    }

    /**
     * Handle the Student "updating" event.
     */
    public function updating(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
