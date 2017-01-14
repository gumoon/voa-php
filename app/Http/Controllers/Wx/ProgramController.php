<?php

namespace voa\Http\Controllers\Wx;

use Illuminate\Http\Request;
use Log;
use voa\Http\Controllers\Controller;
use Redis;
use voa\Events\WxUserInfo;

class ProgramController extends Controller
{
    /**
     * @api {post} /user/info 
     * 
     */
    public function timeline(Request $request)
    {
        $this->validate($request, [
            'access_token' => 'required'
        ]);

    	$accessToken = $request->input('access_token');

    	Log::info($accessToken);
        //验证 access_token 的有效性
        $res = Redis::get($accessToken);
        Log::info($res);
        $tokenInfo = json_decode($res);
        if(empty($tokenInfo) || !isset($tokenInfo->session_key))
        {
            return $this->failedJson(10100, 'access_token invalid');
        }

        //保存用户信息到数据库
        $openid = $tokenInfo->openid;

        return $this->successJson("programs");
    }
}
