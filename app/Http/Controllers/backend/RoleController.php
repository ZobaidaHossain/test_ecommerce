<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Traits\SystemTrait;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RoleController extends Controller
{
    use SystemTrait;

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $PermissionRole = PermissionRole::getPermission('Role',Auth::user()->role_id);
        if(empty($PermissionRole))
        {
            abort(404);
        }
        $data['PermissionAdd']=PermissionRole::getPermission('Add Role', Auth::user()->role_id);
        $data['PermissionEdit']=PermissionRole::getPermission('Edit Role', Auth::user()->role_id);
        $data['PermissionDelete']=PermissionRole::getPermission('Delete Role', Auth::user()->role_id);

        $data['roles'] = $this->roleService->all();
        return view('admin.role.index', $data);
    }


    public function create()
    {
        $PermissionRole = PermissionRole::getPermission('Add Role',Auth::user()->role_id);
        if(empty($PermissionRole))
        {
            abort(404);
        }
        $getPermission=Permission::getRecord();
$data['getPermission']=$getPermission;


        return view('admin.role.form',$data);
    }


    public function store(RoleRequest $request)
    {
        $PermissionRole = PermissionRole::getPermission('Add Role',Auth::user()->role_id);
        if(empty($PermissionRole))
        {
            abort(404);
        }

        $validatedData = $request->validated();
        // $this->roleService->create($validatedData);

        // PermissionRole::InsertUpdateRecord($request->permission_id,$save->id);
        $role = $this->roleService->create($validatedData);

        // Ensure that permissions are processed only if permission IDs are present
        if ($request->has('permission_id') && is_array($request->permission_id)) {
            PermissionRole::InsertUpdateRecord($request->permission_id, $role->id);
        }

        return redirect()->route('backend.role.index')->with('success', 'role created successfully');
    }

    public function show(Role $role)
    {
        abort(404); // Placeholder; return a meaningful response when implemented
    }

    
    public function edit(Role $role)
    {
        $PermissionRole = PermissionRole::getPermission('Edit Role',Auth::user()->role_id);
        if(empty($PermissionRole))
        {
            abort(404);
        }

        $getPermission = Permission::getRecord(); // Fetch all permissions
        // $getRolePermission=PermissionRole::getRolePermission($role);
        $getRolePermission = PermissionRole::getRolePermission($role->id);

        // dd($getRolePermission);
        return view('admin.role.form', compact('role', 'getPermission','getRolePermission'));
        // return view('admin.role.form', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $PermissionRole = PermissionRole::getPermission('Edit Role',Auth::user()->role_id);
        if(empty($PermissionRole))
        {
            abort(404);
        }
        $validatedData = $request->validated();

        $updated = $this->roleService->update($role->id, $validatedData);
        if ($request->has('permission_id') && is_array($request->permission_id)) {
            PermissionRole::InsertUpdateRecord($request->permission_id, $role->id);
        }
        if ($updated) {
            return redirect()->route('backend.role.index')->with('success', 'Role updated successfully');
        }

        return redirect()->route('backend.role.index')->with('error', 'Failed to update the role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $PermissionRole = PermissionRole::getPermission('Delete Role',Auth::user()->role_id);
        if(empty($PermissionRole))
        {
            abort(404);
        }

        $deleted = $this->roleService->delete($role->id); // Delete using OrderService

        if ($deleted) {
            return redirect()->route('backend.role.index')->with('success', 'Role deleted successfully');
        }

        return redirect()->route('backend.role.index')->with('error', 'Failed to delete the role');
    }
}
