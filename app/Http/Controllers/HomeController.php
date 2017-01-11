<?php

namespace voa\Http\Controllers;

use Illuminate\Http\Request;
use voa\Services\Wxdecrypt\WXBizDataCrypt;
use Log;
use voa\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        $appid = 'wxc32591523a670709';
        $sessionKey = 'nFqRpYeVcPbExtRRSPMi1w==';

        $encryptedData="hVCwCN+3mQpv1gYn5gjf7ChLQ3xzR4C/cE4NXxe2CJLuNzLVhmNgYvKrLhd/mZ7Gv3KrbIJ05H9yL6y/3maVdbW7bnS84HJkjrFki+wPe5b4JuTHKZ912OpRQg5CzMdTqyvMwsQaa70o3DD9BzQNGq+pf8xTovKnlheuUAvxU/9HdWIeRxr5JutNTTpBlCDBYPg72+/Tvuzzol8b3g78x1MBYcu4PMjkv3gK7N2AoWzhponip7Cirl/kDwnmb1dEfQ9XyUcuppkIuiwu/W+SugqemKDNMNjs0bpoLOVXECG86WDkXbsQ0qdCGFukQmmxXfP3cJSlGBuBShRIv6bUU5lQYZ9ZO1xzNDBhnDZ7MKvOI/jko3qJ6F5gZgVoz3e7Unzzk5XToydB7IHOiKI+k34C5hLPDQL0tiXSWdWhaqTlFNfxwPYbvv0H1JAzJ3qX9QnxkfPgYr6ZO4CmlVvtFA==";

        $iv = 'KQvuuEMlg13dbA8alHOybA==';

        $pc = new WXBizDataCrypt($appid, $sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data );

        if ($errCode == 0) {
            print($data . "\n");
        } else {
            print($errCode . "\n");
        }
    }
}
