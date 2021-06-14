<?php


namespace App\Services;


use App\Contracts\PermissionContract;
use App\Models\User;
use App\viewModels\RoleHasPermissionModels;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionService implements PermissionContract
{

    public function getAll()
    {
       $permissions = Permission::all();
       return $permissions;
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function create($request)
    {
        $input = $request->input('name');
        $permission = Permission::create(['name'=>$input]);
        $roles = Role::all();
        foreach ($roles as $role){
            $role->givePermissionTo($permission);
        }
        $result ="Create permission success!";
        return  $result;

    }

    public function update($request, $id)
    {
        $input =$request->all();
        $result = array();
       if(array_key_exists('arrayPermission',$input)){
       $permissions = $request->input(['arrayPermission']);
        if(array_key_exists('cancelUser',$input)){
            $users = User::all();
            foreach ($users as $user){
                $user->revokePermissionTo($permissions);
            }
        }elseif (array_key_exists('cancelRole',$input)){
            $roles = Role::all();
            foreach ($roles as $role){
                foreach ($permissions as $item){
                    if($role->hasPermissionTo($item)){
                        $role->revokePermissionTo($permissions);
                        $roleHasPermission =new RoleHasPermissionModels();
                        $roleHasPermission->setRoleId($role->id);
                        $arrayNamePermission =array();
                        foreach ($role->permissions as $permission){
                            array_push($arrayNamePermission,$permission->name);
                        }
                        $roleHasPermission->setPermission($arrayNamePermission);
                        array_push($result,$roleHasPermission);
                    }
                }


            }
        }else{
            return "you do not choose";
        }
       }else{
           return "Permission name is require!";
       }

        return  $result;
    }

    public function delete($request ,$id)
    {
        $result = array('error' => 'error',
            'success' =>'success');
         $input = $request->all();
        $users = User::all();
        foreach ($users as $user){
            foreach ($input['arrayPermission'] as $item){
                if($user->hasPermissionTo($item)){
                    return  $result['error'];
                }else{
                    Permission::destroy($item->id);
                }
            }
        }
        return $result['success'] ;
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }
}
