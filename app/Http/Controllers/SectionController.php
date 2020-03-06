<?php

namespace App\Http\Controllers;

use App\Section;
use App\User;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sections')
            ->with('sectionList', Section::orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('section-edit')
            ->with([
                'section' => new Section(),
                'path' => "/sections",
                'userList' => User::all(),
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
        $this->validateRequest(true);
        $this->save();
        return $this->closeForm();
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
        $section = Section::find($id);
        return view('section-edit')
            ->with([
                'section' => $section,
                'path' => "/sections/$section->id/edit",
                'userList' => User::all(),
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
        $this->validateRequest();
        $section = Section::find($id);
        $this->save($section);

        return $this->closeForm();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        if (!empty($section)) {
            $section->users()->detach();
            $section->delete();
        }
        return $this->closeForm();
    }

    /**
     * Validates the request
     *
     * @param bool $createReq - Shows if it's a creation request.
     * @return mixed
     */
    public function validateRequest($createReq = false)
    {
        $rules = [
            'name' => 'required|max:50',
            'description' => 'max:100',
        ];
        if ($createReq) {
            $rules['name'] .= '|unique:sections';
        }
        return request()->validate($rules);
    }

    /**
     * Saves the request data
     *
     * @param Section $section - The section to save.
     */
    protected function save($section = null)
    {
        $section = $section ?? new Section();
        $logoFile = request()->file("logo");
        $logoFilePath = null;
        if ($logoFile) {
            $logoFilePath = basename($logoFile->store('logo'));
        }
        $reqData = request()->all();
        $users = $reqData["users"] ?? [];
        $userIds = array_keys($users);
        $reqData["logo"] = $logoFilePath;
        $section->name = $reqData["name"];
        $section->description = $reqData["description"];
        $section->logo = $reqData["logo"];
        $section->save();
        if (count($userIds)) {
            $section->users()->detach();
            $section->users()->attach($userIds);
        }
    }
}
