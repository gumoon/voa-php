<?php

namespace voa\Http\Controllers\Wx;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Log;

class AuthController extends Controller
{
    /**
     * 
     */
    public function session(Request $request)
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

        $this->successJson($res->getBody());
    }
}
