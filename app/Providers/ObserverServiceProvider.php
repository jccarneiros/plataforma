<?php

namespace App\Providers;

use App\Models\Discipline;
use App\Models\President;
use App\Models\Professor;
use App\Models\Room;
use App\Models\Sala;
use App\Models\Serie;
use App\Models\Student;
use App\Models\TipoEnsino;
use App\Models\Tutor;
use App\Models\User;
use App\Observers\DisciplineObserver;
use App\Observers\PresidentObserver;
use App\Observers\ProfessorObserver;
use App\Observers\RoomObserver;
use App\Observers\SalaObserver;
use App\Observers\SerieObserver;
use App\Observers\StudentObserver;
use App\Observers\TipoEnsinoObserver;
use App\Observers\TutorObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        User::observe(UserObserver::class);
        TipoEnsino::observe(TipoEnsinoObserver::class);
        Serie::observe(SerieObserver::class);
        Room::observe(RoomObserver::class);
        Discipline::observe(DisciplineObserver::class);
        Student::observe(StudentObserver::class);
        Sala::observe(SalaObserver::class);
        Tutor::observe(TutorObserver::class);
        President::observe(PresidentObserver::class);
        Professor::observe(ProfessorObserver::class);
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
}
