<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('role')->where('roles_id', '<>', config('ad.admin'))->orderBy('id', 'desc');
        $all = $user->get();
        $list = $user->paginate(config('ad.paginate'));
        
        return view('admin.list_user', compact('list', 'all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $req)
    {
        $user = new User();
        $user->username = $req->username;
        $user->email = $req->email;
        $user->password = $req->password;
        $user->roles_id = $req->roles_id;
        $user->status = $req->status;
        $user->save();

        return redirect()->route('list_user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailUser = User::where('id', $id)->firstOrFail();

        return view('admin.read_user', compact('detailUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userEdit = User::where('id', $id)->firstOrFail();

        return view('admin.update_user', compact('userEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $req, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $req->username;
        $user->password = $req->password;
        $user->roles_id = $req->roles_id;
        $user->status = $req->status;
        $user->save();

        return redirect()->route('list_user');
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
