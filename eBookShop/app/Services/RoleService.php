<?php


namespace App\Services;

use App\Contracts\RoleContract;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleService implements  RoleContract
{

    public function getAll()
    {

        $role = Role::all();
        return $role;
    }

    public function show($id)
    {

    }

    public function create($request)
    {
        $name =$request->input('name');
        $role= Role::create(['name'=>$name]);
         $permission= Permission::all();
         $role->givePermissionTo($permission);
         return $role;
    }

    public function update($request, $id)
    {
        $role = Role::findOrFail($id);
        $input = $request->all();
        $role->syncPermissions($input['arrayIdPermission']);
        return $role->permissions;
    }

    public function delete($id)
    {
        $check =false;
        $result = array('error' => 'error',
                        'success' =>'success');
        $role = Role::findOrFail($id);
        $users = User::all();
        foreach ($users as $user){
            if($user->hasRole($role->name)){
                  $check = true;
               return  $result['error'];
            }
        }
        if($check ===false){
            Role::destroy($id);
        }
        return $result['success'] ;
    }

    public function edit($id)
    {
        $arrayData =array();
        $arrayRoleHasPermission = array();
         $role =  Role::findOrFail($id);
         $permissions = Permission::all();
        $roleHasPermission =$role->permissions;
        foreach ($roleHasPermission as $idPermission){
            array_push($arrayRoleHasPermission,$idPermission->id);
        }
        array_push($arrayData, $role);
        array_push($arrayData, $permissions);
        array_push($arrayData, $arrayRoleHasPermission);

         return $arrayData;
    }
}
