<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Contracts\Session\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $role = Role::all();
        return view('admin.role.index',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $name =$request->input('name');
         $permission = $request->input('roles_permissions');
        $stringEdit =  preg_replace('/[-\s]+/', '-', strtolower(trim($permission)));
        $namePermissions = explode(',', $stringEdit);
         $result = Role::all()->where('name',$name)->first();
          if($result === null ){

               if($namePermissions !==null){
                   $count =0;
                   foreach ($namePermissions as $namePermission){
                      $result =  Permission::all()->where('name',$namePermission)->first();
                        /*if($result ===null){
                             $permis = Permission::create(['name' => $namePermission]);
                            $role->givePermissionTo($permis);*/

                        //}else{
                         if($result !==null){
                              $count =1;

                            $request->session()->flash('error-exists-Permis','Permisson is exists!');
                            return redirect()->back();
                        }

                   }
                   if($count ==0){
                       $role = Role::create(['name' => $name]);
                         if(!empty($namePermissions[0])){
                             foreach ($namePermissions as $namePermission){
                                 $permis = Permission::create(['name' => $namePermission]);
                                 $role->givePermissionTo($permis);
                             }
                         }

                   }

               }
              $request->session()->flash('create-role','Role create success!');
              return redirect()->route('role.index');
          }else{
              $request->session()->flash('error-create-Role','Role is exists!');
              return redirect()->back();
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $role = Role::findOrFail($id);
      return view('admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $nameRole = $request->input('name');
        $role = Role::findById($id);
        $role->name = $nameRole;
        $role->save();
        $idPermission = $request->input('roles_permissions');

        $stringEdit =  preg_replace('/[-\s]+/', '-', strtolower(trim($idPermission)));
        $editNamePermissions = explode(',', $stringEdit);

        $Permis =array();
        $stack = array();
        $arrPermis = Permission::all();

        if($idPermission ===null){
            return redirect()->route('role.index');
        }
        //delete permissions
       foreach ($role->permissions as $permission){

       if (in_array($permission->name, $editNamePermissions) == false){
                   $role->revokePermissionTo($permission);
        }

    }
       //add permissions

        foreach ($arrPermis as $item){
                array_push($Permis,$item->name);
        }

        foreach ($editNamePermissions as $items) {

            if (in_array($items, $Permis)) {
                $tempPermission = $items;
                if(in_array($tempPermission, $stack) == false){
                    array_push($stack, $tempPermission);
                }
                $index= array_search($items, $editNamePermissions);
                unset($editNamePermissions[$index]);

            }
        }

        if(!empty($editNamePermissions)) {
            foreach ($editNamePermissions as $editNamePermission) {
                Permission::create(['name' => $editNamePermission]);
            }
        }

        if (!empty($stack)) {


             $array_permission = array_merge($stack,$editNamePermissions);
            foreach ($array_permission as $editNamePermission) {

                $role->givePermissionTo($editNamePermission);

            }
        }
        else{
                foreach ($editNamePermissions as $editNamePermission) {
                     $permission =  Permission::create(['name'=>$editNamePermission]);
                    $role->givePermissionTo($permission);

                }
            }

        $request->session()->flash('update-role','The Role update success!');

     return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //   $role = Role::findOrDetail($id);
          Role::destroy($id);
        \Illuminate\Support\Facades\Session::flash('delete-role','Role delete success!');
        return redirect()->back();
    }
}
