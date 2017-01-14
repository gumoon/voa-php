<?php

namespace voa\Http\Controllers\Admin;

use Illuminate\Http\Request;
use voa\Http\Controllers\Controller;
use voa\Models\Anchor;
use Config;

class AnchorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anchors = Anchor::all();

        return view('admin.anchors.index', ['anchors' => $anchors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.anchors.create');
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
        ]);

        $name = $request->input('name');
        $profile_image_url = $request->input('profile_image_url');
        $gender = $request->input('gender');
        $intro = $request->input('intro');

        $anchor = new Anchor;
        $anchor->name = $name;
        $anchor->profile_image_url = $profile_image_url;
        $anchor->gender = $gender;
        $anchor->intro = $intro;

        $anchor->save();

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
        $anchor = Anchor::find($id);
        $anchor->image_url_src = $anchor->profile_image_url ? Config::get('app.ossDomain').$anchor->profile_image_url : '';

        return view('admin.anchors.edit', ['anchor' => $anchor]);
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
        ]);

        $name = $request->input('name');
        $profile_image_url = $request->input('profile_image_url');
        $gender = $request->input('gender');
        $intro = $request->input('intro');

        $anchor = Anchor::find($id);
        $anchor->name = $name;
        $anchor->profile_image_url = $profile_image_url;
        $anchor->gender = $gender;
        $anchor->intro = $intro;

        $anchor->save();

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
