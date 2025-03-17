<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    //this method will show permissions page
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);
        return view("permissions.list", [
            'permissions' => $permissions
        ]);

    }

    //this method will show create permissions page
    public function create()
    {
        return view("permissions.create");
    }

    //this method will show insert permissions in DB
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|unique:Permissions|min:3",
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);

            return redirect()->route('permissions.index')->with('success', 'Permissions added successfully.');

        } else {
            return redirect()->route('permissions.create')->withErrors($validator)->withInput();
        }
    }

    //this method will show edit permissions page
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view("permissions.edit", [
            'permission' => $permission
        ]);
    }

    //this method will update permissions 
    public function update($id, Request $request)
    {
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,.$id.,id'
        ]);

        if ($validator->passes()) {
            // Permission::create(['name' => $request->name]);

            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('success', 'Permissions Updated successfully.');

        } else {
            return redirect()->route('permissions.create')->withErrors($validator)->withInput();
        }

    }

    //this method will delete permissions 
    public function destroy(Request $request)
    {
        $id = $request->id;

        $permission = Permission::find($id);

        if ($permission == null) {
            session()->flash('error', 'Permission not found');
            return response()->json([
                'status' => false
            ]);
        }

        $permission->delete();
            session()->flash('success', 'Permission delete successfully');
            return response()->json([
                'status' => true
            ]);
    

}
}
