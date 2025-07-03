<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function list()
    {
        $PermissionUser = PermissionRole::getPermission('User', Auth::user()->role_id);
        if(empty($PermissionUser))
        {
            abort(404);
        }
        $data['PermissionAdd']=PermissionRole::getPermission('Add User', Auth::user()->role_id);
        $data['PermissionEdit']=PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        $data['PermissionDelete']=PermissionRole::getPermission('Delete User', Auth::user()->role_id);

        $data['getRecord']=User::getRecord();
        return view('admin.user.list',$data);
    }
    public function add(){
        $PermissionUser = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        if(empty($PermissionUser))
        {
            abort(404);
        }



        $data['getRole']=Role::getRecord();
        return view('admin.user.add',$data);
    }

    public function insert(Request $request)
    {
        $PermissionUser = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        if(empty($PermissionUser))
        {
            abort(404);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect()->route('backend.user.list')->with('success', 'User successfully created');
    }

    public function edit($id)
    {
        $PermissionUser = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        if(empty($PermissionUser))
        {
            abort(404);
        }
        $data['getRecord']=User::getSingle($id);
        $data['getRole']=Role::getRecord();
        return view('admin.user.edit',$data);
    }
    public function update(Request $request, $id)
{
    $PermissionUser = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        if(empty($PermissionUser))
        {
            abort(404);
        }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role_id' => 'required|exists:roles,id',
    ]);

    $user = User::findOrFail($id); // Fetch the existing user by ID
    $user->name = trim($request->name);
    $user->email = trim($request->email);
    $user->role_id = trim($request->role_id);
    $user->save();

    return redirect()->route('backend.user.list')->with('success', 'User successfully updated');
}


public function delete($id)
{
    $PermissionUser = PermissionRole::getPermission('Delete User', Auth::user()->role_id);
        if(empty($PermissionUser))
        {
            abort(404);
        }
    $user = User::findOrFail($id); // Fetch the user by ID
    $user->delete();

    return redirect()->route('backend.user.list')->with('success', 'User successfully deleted');
}

}
