<?php

namespace voa\Providers;

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
        'voa\Events\WxUserLogin' => [
            'voa\Listeners\RecordOpenId',
        ],
        'voa\Events\WxUserInfo' => [
            'voa\Listeners\RecordWxUserInfo'
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
