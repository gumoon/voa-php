<?php

namespace voa\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //VOA节目4个大类
    protected $programCategories = array(
        '其他类型',
        '音频节目',
        '视频节目',
        '音视频节目'
    );

    //VOA节目分三个level
    protected $levels = array(
        array(
            'id' => 1,
            'name' => 'Level One'
        ),
        array(
            'id' => 2,
            'name' => 'Level Two'
        ),
        array(
            'id' => 3,
            'name' => 'Level Three'
        ),
    );

    //封装成功返回的json
    protected function successJson($data = null)
    {
    	$ret = array(
    		'err_no' => 0,
    		'msg' => '成功',
    		'data' => $data ? $data : new \stdClass
    	);

    	return response()->json( $ret );
    }


    //封装错误返回的json
    protected function failedJson($errNo, $msg)
    {
        $ret = array(
            'err_no' => $errNo,
            'msg' => $msg,
            'data' => new \stdClass
        );

        return response()->json( $ret );
    }
}
