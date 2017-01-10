<?php

namespace voa\Http\Controllers\Wx;

use Illuminate\Http\Request;
use Log;
use voa\Http\Controllers\Controller;
use Redis;

class UserController extends Controller
{
    /**
     * @api {post} /user/info 
     * 
     */
    public function info(Request $request)
    {
    	$accessToken = $request->input('access_token');

    	Log::info($accessToken);

        $res = Redis::get($accessToken);
        Log::info($res);


        $ret = array(
            'err_no' => 0,
            'msg' => '成功',
            'data' => new \stdClass
        );
        Log::info($ret);
        return response()->json( $ret );
    }
}
