<?php

namespace App\Http\Controllers;
use App\Contracts\PermissionContract;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public $permissionContract ;
     public function __construct(PermissionContract $permissionContract ){
         $this->permissionContract =$permissionContract;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $arrPermissions =  $this->permissionContract->getAll();
        return response()->json(['arrPermissions'=>$arrPermissions]);
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
          $result = $this->permissionContract->create($request);
           return response()->json(['result'=>$result]);

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
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
             $result = $this->permissionContract->update($request,$id);
             return  response()->json(['result'=>$result]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request ,$id)
    {
           $result =  $this->permissionContract->delete($request,$id);
        return  response()->json(['result'=>$result]);
    }
}
