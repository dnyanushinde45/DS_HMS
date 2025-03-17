<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //this method will show role page
    public function index(){
        $roles = Role::orderBy('name', 'ASC')->paginate(5);
        return view('roles.list', [
            'roles'=> $roles
        ]);
    }

    //this method will create role 
    public function create(){
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('roles.create', [
            'permissions'=> $permissions
        ]);
    }

    //this method will store role in db
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|unique:roles|min:3",
        ]);

        if ($validator->passes()) {

            // for test
            // dd($request->permission);

            $role = Role::create(['name' => $request->name]);

            if(!empty( $request->name)){
                foreach( $request->permission as $name){
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('roles.index')->with('success', 'Roles added successfully.');

        } else {
            return redirect()->route('roles.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        $haspermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'asc')->get();

        // for test
        // dd($haspermissions);
        return view('roles.edit', [
            'permissions' => $permissions,
            'haspermissions' => $haspermissions,
            'role'=> $role
        ]);
    }

    public function update($id, Request $request){
        $role = Role::findOrFail($id);


        $validator = Validator::make($request->all(), [
            "name" => "required|unique:roles,name, ' .$id.' ,id"
        ]);

        if ($validator->passes()) {

            // for test
            // dd($request->permission);

            $role->name = $request->name;
            $role->save();

            if(!empty( $request->permission)){
                $role->syncPermissions($request->permission);
                }
                else{
                    $role->syncPermissions([]);
                }
            

            return redirect()->route('roles.index')->with('success', 'Roles Updated successfully.');

        } else {
            return redirect()->route('roles.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $role = Role::findOrFail($id);

        if($role == null){
            session()->flash('error','Role not found.');
            return response()->json([
                'status' => false
            ]);
        }
        $role->delete();

        session()->flash('success','Role deleted successfully.');
        return response()->json([
            'status' => false
        ]);
    }
}

