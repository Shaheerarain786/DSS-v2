<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        $authId = auth()->user()->is_super;
        if ( $authId == false) {
            $get_all_users = User::query()->where('id', auth()->user()->id)->get();
        }
        else{
            $get_all_users = User::query()->get();
        }
        return view('admin.users.index', compact('get_all_users','authId'));
    }


    public function create()
    {
        //
    }

    public function store(UserRequest $request)
    {
        User::query()->create($request->all());

        return redirect('users')->with('success','user created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('users')->with('success','User Updated Successfully');
    }

    public function destroy($id, Request $request)
    {
        $password = $request->password;

        $hashed_password = User::query()->find(auth()->user()->id);

        if(Hash::check($password , $hashed_password->password) == false)
        {
            return back()->with('success','Password Not Matched');
        }

        User::find($id)->delete();

        return back()->with('success','User deleted Successfully');
    }
}
