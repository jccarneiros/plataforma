<?php

namespace App\Providers;

use App\Events\GetDataDisciplineAulasDadasConselhoEscolaEvent;
use App\Events\GetDataDisciplineAulasDadasTeacherEvent;
use App\Events\GetDataStudentUpdate;
use App\Listeners\UpdateDataAulasDadasConselhoEscolaDiscipline;
use App\Listeners\UpdateDataAulasDadasTeacherFechamento;
use App\Listeners\UpdateDataStudentFechamento;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        GetDataDisciplineAulasDadasTeacherEvent::class => [
            UpdateDataAulasDadasTeacherFechamento::class,
        ],
        GetDataStudentUpdate::class => [
            UpdateDataStudentFechamento::class,
        ],
        GetDataDisciplineAulasDadasConselhoEscolaEvent::class => [
            UpdateDataAulasDadasConselhoEscolaDiscipline::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
    //    /**
    //     * The model observers for your application.
    //     *
    //     * @var array
    //     */
    //    protected $observers = [
    //        TipoEnsino::class => [TipoEnsinoObserver::class],
    //    ];
}
