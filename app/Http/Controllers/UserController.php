<?php

namespace App\User;

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users')
            ->with('userList', User::orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user-edit', [
            'user' => new User(),
            'path' => "/users",
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
        User::create($request->all());
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
        $user = User::find($id);
        return view('user-edit', [
            'user' => $user,
            'path' => "/users/$user->id/edit",
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
        $user = User::find($id);
        $reqData = request()->all();
        $reqData["password"] = $reqData["password"] ?
            Hash::make($reqData["password"]):
            $user->password;
        User::find($id)->update($reqData);
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
        $user = User::find($id);
        if (!empty($user)) {
            $user->sections()->detach();
            $user->delete();
        }
        return $this->closeForm();
    }

    /**
     * Validates the request
     *
     * @param bool $createReq - Indicates if it's a creation request.
     * @return mixed
     */
    public function validateRequest($createReq = false)
    {
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|max:254',
            'password' => 'max:50',
        ];
        if ($createReq) {
            $rules['email'] .= '|unique:users';
        }
        return request()->validate($rules);
    }
}
