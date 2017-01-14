<?php

namespace voa\Http\Controllers\Admin;

use Illuminate\Http\Request;
use voa\Http\Controllers\Controller;
use voa\Models\Program;
use voa\Models\Anchor;
use voa\Models\ProgramType;
use Config;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();

        return view('admin.programs.index', ['programs' => $programs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anchors = Anchor::all();

        return view('admin.programs.create', [
                'programCategories' => $this->programCategories, 
                'levels' => $this->levels,
                'anchors' => $anchors
            ]);
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
            'title' => 'required',
            'anchor_id' => 'bail|required|exists:anchors,id',
            'program_type_id' => 'bail|required|exists:program_types,id',
            'level' => 'required|in:1,2,3',
            'image_url' => 'required',
            'content' => 'required',
            'published_at' => 'required'
        ]);

        $program = new Program;
        $program->title = $request->input('title');
        $program->anchor_id = $request->input('anchor_id');
        $program->program_type_id = $request->input('program_type_id');
        $program->level = $request->input('level');
        $program->image_url = $request->input('image_url');
        $program->audio_url = $request->input('audio_url');
        $program->video_url = $request->input('video_url');
        $program->content = $request->input('content');
        $program->published_at = $request->input('published_at');

        $program->save();

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
        $program = Program::find($id);
        $program->image_url_src = $program->image_url ? Config::get('app.ossDomain').$program->image_url : '';

        $anchors = Anchor::all();
        $catTypes = ProgramType::where('category_id', $program->programType->category_id)
                        ->get();

        return view('admin.programs.edit', [
            'program' => $program, 
            'programCategories' => $this->programCategories,
            'anchors' => $anchors, 
            'levels' => $this->levels,
            'catTypes' => $catTypes
        ]);
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
        //
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

    /**
     * 根据cat_id 获取 types
     * 
     */
    public function getTypesByCatId(Request $request)
    {
        $category_id = $request->input('category_id');

        $types = ProgramType::where('category_id', $category_id)
                    ->get();

        return $this->successJson($types);
    }
}
