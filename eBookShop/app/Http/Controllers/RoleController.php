<?php

namespace App\Http\Controllers;
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $role = Role::create(['name' => 'writer']);

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


        // $permission = Permission::all()->pluck(
        //     'name',
        //      'id'
        // );

      return view('admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        //
    }
}
