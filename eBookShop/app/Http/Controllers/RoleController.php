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

       $permission = Permission::all();

        $arrayIdPermiss = array();
        $IdPermiss =$role->permissions;
        foreach ($IdPermiss as $idPermiss){
            array_push($arrayIdPermiss,$idPermiss->id);
        }

      return view('admin.role.edit',compact('role','permission','arrayIdPermiss'));
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
        $role = Role::findOrFail($id);
        $input = $request->all();
        $arrayNamePermission = array();
        $originPermission = Permission::all();

        foreach ($originPermission as $namePermission){
            array_push($arrayNamePermission,$namePermission->name);
        }


        if(array_key_exists('arrayIdPermiss',$input))
        {
            foreach ($originPermission as $permission){
                if(in_array($permission,$input['arrayIdPermiss']) === false){

                    $role->revokePermissionTo($permission);
                }
            }
            $role->givePermissionTo($input['arrayIdPermiss']);
        }else{
            $role->syncPermissions([]);
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
