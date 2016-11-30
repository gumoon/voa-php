<?php

namespace voa\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use voa\Http\Controllers\Controller;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = DB::table('programs')->get();

        return view('admin.programs.index', ['programs' => $programs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(array('a' => 'b'));

        $name = $request->input('name');
        $intro = $request->input('intro');
        $type = $request->input('type');
        $status = $request->input('status');

        $postData = array(
            'name' => $name,
            'intro' => $intro,
            'type' => $type,
            'status' => $status,
        );

        $id = DB::table('programs')->insertGetId($postData);

        if( $request->is('*/ajax/*') )
        {
            $ret = array(
                'errno' => 0,
                'msg' => 'success',
                'data' => array()
            );
            if( $id <= 0 )
            {
                //抛例外
            }

            return response()->json($ret);
        }
        else
        {
            return redirect('/houtai/programs');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = intval($id);
        $program = DB::table('programs')->where('id', $id)->first();

        return view('admin.programs.edit', ['program' => $program]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $intro = $request->input('intro');
        $type = $request->input('type');
        $status = $request->input('status');

        $postData = array(
            'name' => $name,
            'intro' => $intro,
            'type' => $type,
            'status' => $status,
        );

        $id = intval($id);
        $affectRows = DB::table('programs')->where('id', $id)->update($postData);

        if( $request->is('*/ajax/*') )
        {
            $ret = array(
                'errno' => 0,
                'msg' => 'success',
                'data' => array('')
            );
            if( $affectRows < 1)
            {
                //抛错误
            }

            return response()->json($ret);
        }
        else
        {
            return redirect('/houtai/programs');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
