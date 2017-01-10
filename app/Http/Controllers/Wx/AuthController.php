<?php

namespace voa\Http\Controllers\Wx;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Log;
use voa\Http\Controllers\Controller;
use Redis;

class AuthController extends Controller
{
    /**
     * @api {post} /auth/token 小程序获取访问服务器的token
     * 
     */
    public function token(Request $request)
    {
    	$code = $request->input('code');
    	Log::info($code);
    	// https://api.weixin.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code
        $client = new Client();
        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        $tmp = array(
            'appid' => env('WXMINIAPP_APPID'),
            'secret' => env('WXMINIAPP_APPSECRET'),
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        );

        $res = $client->request('get', $url, ['query' => $tmp]);
        Log::info($res->getBody());
        $data = json_decode($res, true);

        //接口调用出错的情况
        if(isset($data['errcode']) && !empty($data['errcode']))
        {
        	$this->failedJson($data['errcode'], $data['errmsg']);
        }

        //生成我们自己的 access_token
        $accessToken = bcrypt(env('WXMINIAPP_APPID'));

        //存储到redis中
        Redis::set($accessToken, $res);

        $this->successJson($accessToken);
    }
}
