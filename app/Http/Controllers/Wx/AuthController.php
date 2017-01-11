<?php

namespace voa\Http\Controllers\Wx;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Log;
use voa\Http\Controllers\Controller;
use Redis;
use voa\Events\WxUserLogin;

class AuthController extends Controller
{
    /**
     * @api {post} /auth/token 小程序获取接口调用的token
     * 
     */
    public function token(Request $request)
    {
    	$this->validate($request, [
    		'code' => 'required'
    	]);

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

        $resp = $client->request('get', $url, ['query' => $tmp]);
        Log::info($resp->getBody());
        $respBody = $resp->getBody();
        $res = json_decode($respBody);

        //接口调用出错的情况
        if(isset($res->errcode) && !empty($res->errcode))
        {
	        $err = array(
	    		'err_no' => $res->errcode,
	    		'msg' => $res->errmsg,
	    		'data' => new \stdClass
	    	);

	    	return response()->json( $err );
        }

        //生成我们自己的 access_token
        $accessToken = bcrypt(env('WXMINIAPP_APPID'));

        $data = array(
        	'session_key' => $res->session_key,
        	'expires_in' => $res->expires_in,
        	'openid' => $res->openid
        );
        //存储到redis中,1小时过期
        Redis::setex($accessToken, 3600, json_encode($data));

        //往数据库添加一条用户登录记录
        event(new WxUserLogin($res->openid));

        Log::info($accessToken);
        $ret = array(
        	'access_token' => $accessToken
        );

        return $this->successJson($ret);
    }
}
