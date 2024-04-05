<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){

         Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'role_as'=>'required',
            'password'=>'required'
        ])->validated();
        

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_as = $request->role_as;
        $user->password = $request->password;
        $user->save();


        return redirect()->route('users.index')->with('message','User Created Successfully');
 
    }


    public function edit($id){
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request , $id)
    {
        $user = User::find($id);
        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_as = $request->role_as;
            $user->update();
            return redirect()->route('users.index')->with('message','User updated Successfully✔✔');
        }else{
            return redirect()->route('users.index')->with('message','User Not Found🥵🥵');

        }
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
    
        return redirect()->back()->with('message', 'User Deleted Successfully!!');
    }

    public function profiles(){
        return view('admin.profiles.view');
    }

    public function profileupdate(Request $request) {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Check if password field is not empty
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
    
        // Redirect to some route after profile update
        return redirect('admin/profiles')->with('message', 'Profile updated successfully');
    }
    
}
