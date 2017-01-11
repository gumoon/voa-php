<?php

namespace voa\Listeners;

use voa\Events\WxUserLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use voa\Models\WxAccount;

class RecordOpenId implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WxUserLogin  $event
     * @return void
     */
    public function handle(WxUserLogin $event)
    {
        Log::info('RecordOpenId: '. $event->openid);

        $data = ['openid' => $event->openid];
        $wxAccount = WxAccount::firstOrCreate($data);

        Log::info($wxAccount);
    }
}
