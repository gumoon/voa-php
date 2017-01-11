<?php

namespace voa\Http\Controllers\Wx;

use Illuminate\Http\Request;
use Log;
use voa\Http\Controllers\Controller;
use Redis;
use voa\Events\WxUserInfo;

class UserController extends Controller
{
    /**
     * @api {post} /user/info 
     * 
     */
    public function info(Request $request)
    {
        $this->validate($request, [
            'access_token' => 'required'
        ]);

    	$accessToken = $request->input('access_token');
        $nickName = $request->input('nick_name');
        $gender = $request->input('gender');
        $language = $request->input('language');
        $city = $request->input('city');
        $province = $request->input('province');
        $country = $request->input('country');
        $avatarUrl = $request->input('avatar_url');

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
        $data = array(
            'nick_name' => $nickName,
            'gender' => $gender ? $gender : 0,
            'language' => $language,
            'city' => $city,
            'province' => $province,
            'country' => $country,
            'avatar_url' => $avatarUrl
        );
        event(new WxUserInfo($openid, $data));

        return $this->successJson();
    }
}
