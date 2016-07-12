<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\TicketCreated' => [
            'App\Listeners\EmailTicketCreated',
        ],
        'App\Events\TicketUpdated' => [
            'App\Listeners\EmailTicketUpdated',
        ],
        'App\Events\TicketResponseCreated' => [
            'App\Listeners\EmailTicketResponseCreated',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
