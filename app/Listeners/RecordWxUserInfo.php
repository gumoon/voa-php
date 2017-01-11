<?php

namespace voa\Listeners;

use voa\Events\WxUserInfo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use voa\Models\WxAccount;

class RecordWxUserInfo implements ShouldQueue
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
     * @param  WxUserInfo  $event
     * @return void
     */
    public function handle(WxUserInfo $event)
    {
        Log::info('RecordWxUserInfo: openid: '. $event->openid);

        $openid = $event->openid;
        $userInfo = $event->userInfo;

        $account = WxAccount::where('openid', $openid)->first();

        $wxAccount = WxAccount::find($account->id);
        $wxAccount->nick_name = $userInfo['nick_name'];
        $wxAccount->gender = $userInfo['gender'];
        $wxAccount->language = $userInfo['language'];
        $wxAccount->city = $userInfo['city'];
        $wxAccount->province = $userInfo['province'];
        $wxAccount->country = $userInfo['country'];
        $wxAccount->avatar_url = $userInfo['avatar_url'];

        $wxAccount->save();
    }
}
