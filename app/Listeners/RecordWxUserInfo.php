<?php

namespace voa\Listeners;

use voa\Events\WxUserInfo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use voa\Models\WxUser;

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

        $account = WxUser::where('openid', $openid)->first();

        $wxUser = WxUser::find($account->id);
        $wxUser->nick_name = $userInfo['nick_name'];
        $wxUser->gender = $userInfo['gender'];
        $wxUser->language = $userInfo['language'];
        $wxUser->city = $userInfo['city'];
        $wxUser->province = $userInfo['province'];
        $wxUser->country = $userInfo['country'];
        $wxUser->avatar_url = $userInfo['avatar_url'];

        $wxUser->save();
    }
}
