<?php

namespace App\Providers;

use App\Listeners\LivroMakeTotal;
use App\Listeners\LivroRankingUpdate;
use CodeEduBook\Events\LivroPreIndexEvent;
use CodeEduStore\Events\OrderPostProcessEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        LivroPreIndexEvent::class => [
          LivroMakeTotal::class
        ],
        OrderPostProcessEvent::class => [
            LivroRankingUpdate::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
