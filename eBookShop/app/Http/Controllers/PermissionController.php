<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::all();
        return view('admin.permission.index',compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $permission = $request->input('permissions');
        $stringEdit =  preg_replace('/[-\s]+/', '-', strtolower(trim($permission)));
        $namePermissions = explode(',', $stringEdit);
            $count = 0;
            foreach ($namePermissions as $namePermission) {
                $result = Permission::all()->where('name', $namePermission)->first();

                if ($result !== null) {
                    $count = 1;
                    return redirect()->back()->withErrors(['Permisson is exists!']);
                }else{
                     Permission::create(['name' => $namePermission]);
                }

            }
        session()->flash('create-permission','The Permission create success!');
            return redirect()->route('permission.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $role = Role::all();
        $arrayIdRole = array();
        $IdRole =$permission->roles;
        foreach ($IdRole as $idRoles){
            array_push($arrayIdRole,$idRoles->id);

        }

        return view('admin.permission.edit',compact('permission','role','arrayIdRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
         $assignRole = $request->input('arrayIdRole');
        $name =  preg_replace('/[-\s]+/', '-', strtolower(trim($request->input('name'))));
        $checkName = Permission::all()->where('name',$name)->first();
          $arrRoleHasPermission = $permission->roles;
          $arrIdRole = array();
           foreach ($arrRoleHasPermission as $item){
                    array_push($arrIdRole,$item->id);
           }

         //remove role_has_permission
        if($assignRole!==null){

            foreach ($arrIdRole as $role){
                if(in_array($role,$assignRole) == false){

                     $isRole = Role::findOrFail($role);
                    $permission->removeRole($isRole);
                }
            }
        }



        if($checkName === null && $assignRole !== null ||
            $assignRole !== null && $checkName !== null && $checkName->name ===$permission->name){
            $permission->name =$name;
            foreach ($assignRole as $items){
                $role =  Role::findOrFail($items);
                $permission->assignRole($role);

            }
            $permission->save();

        }elseif($checkName !== null && $checkName->name !== $permission->name){
            return redirect()->back()->withErrors(['Name permission is exists!']);
        }elseif($assignRole === null && $checkName === null
            ||$assignRole === null && $checkName !== null && $checkName->name ===$permission->name){
            $permission->name =$name;
            $permission->save();
            $permission->syncRoles([]);

            $request->session()->flash('update-permission','The Permission update success!');
            return redirect()->route('permission.index');
        }

        $request->session()->flash('update-permission','The Permission update success!');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Permission::destroy($id);
        session()->flash('delete-permission','The Permission delete success!');
        return  redirect()->back();
    }
}
