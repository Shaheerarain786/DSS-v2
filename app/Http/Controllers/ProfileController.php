<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
class ProfileController extends Controller
{
    //
    public function index(){
        $profileData = Auth::user();
        return view('admin.profile', compact('profileData'));
    }
    public function update(ProfileRequest $request){
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->update();
        return redirect('profile')->with('success','Profile Updated Successfully');
    }
}
