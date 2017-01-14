<?php

namespace voa\Http\Controllers\Admin;

use Illuminate\Http\Request;
use voa\Models\ProgramType;
use voa\Http\Controllers\Controller;


class ProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programTypes = ProgramType::all();

        return view('admin.program_types.index', ['programTypes' => $programTypes, 'programCategories' => $this->programCategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.program_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required|in:0,1,2,3',
        ]);

        $programType = new ProgramType;

        $programType->name = $request->input('name');
        $programType->desc = $request->input('desc');
        $programType->category_id = $request->input('category_id');
        $programType->is_recommend = $request->input('is_recommend', 0);

        $programType->save();

        return $this->successJson();        
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

        $programType = ProgramType::findOrFail($id);

        return view('admin.program_types.edit', ['programType' => $programType]);
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
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required|in:0,1,2,3'
        ]);

        $id = intval($id);
        $programType = ProgramType::find($id);

        $programType->name = $request->input('name');
        $programType->desc = $request->input('desc');
        $programType->category_id = $request->input('category_id');
        $programType->is_recommend = $request->input('is_recommend');

        $programType->save();

        return $this->successJson();
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
