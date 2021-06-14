<?php namespace App\Services;

use App\Models\Photo;
use App\Models\User;
use App\Contracts\UserContract;
use App\viewModels\TreeModels;
use App\viewModels\childModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserService implements UserContract
{

    public function getAll()
    {

        $user = User::all();
        $arrRole = Role::all();
        $result = array('user' => $user, 'arrayRole' => $arrRole);
        return $result;
    }

    public function show($id)
    {
        $users = User::findOrFail($id);
        return $users;
    }

    public function create($request)
    {

        $user = User::create([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'address' => $request['address'],
            'phoneNumber' => $request['phoneNumber'],
            'userName' => $request['userName'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        if(array_key_exists('arrayRole',$request->all())){
            if(in_array("Administrator", $request['arrayRole'])){
                $user->syncRoles("Administrator");
                $allPermission =  Permission::all();
                $user->givePermissionTo($allPermission);
            }
            else{
                $user->assignRole($request['arrayRole']);
                $permission = Permission::all();
                $user->syncPermissions($permission);
            }

        }
        return $user;
    }

    public function update($request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;

        }


        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->userName = $request->input('userName');
        $email = User::all()->where('email', $input['email'])->first();
        if ($email === $user->email && $email !== null || $email === null) {
            $user->email = $request->input('email');
        }

        if($request->password !==null){
            $input['password'] = bcrypt($request->password);
            $user->password = $input['password'];
        }
        if (array_key_exists('photo_id', $input)) {
            $user->photo_id = $input['photo_id'];
        }

        $user->save();

        $request->session()->flash('update-user', 'User update success!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->photo) {
            unlink(public_path() . $user->photo->file);
            $user->photo->delete();
        }
        $user->delete();

       return "Delete success!";
    }

    public function addRole($request, $id)
    {
        $dataChecked = $request->all();

       $checked =[];
       $user = User::findOrFail($id);
        $tempPermissions = [];
        $permissionsArray = DB::table('permissions')->pluck('name')->toArray();

       if (array_key_exists('data',$dataChecked)) {
        $checked =$dataChecked['data'];
            foreach ($permissionsArray as $permission) {
                if (in_array($permission, $checked) !== false) {
                    array_push($tempPermissions, $permission);
                   $index = array_search($permission, $checked);
                   unset($checked[$index]);
                }
            }
            if (count($checked) === 0) {
                $this->removeAllRolePermissionByUser($user);

            } else {
                if(in_array("Administrator", $checked)){
                    $user->syncRoles("Administrator");
                      $allPermission =  Permission::all();
                    $user->givePermissionTo($allPermission);
                }else{
                    $user->syncRoles($checked);
                    $havePermissions = $user->getAllPermissions();
                    foreach ($havePermissions as $item) {
                        if (in_array($item, $tempPermissions) === false) {
                            $user->revokePermissionTo($item);
                            // $i = array_search($item, $tempPermissions);
                            //    unset($tempPermissions[$i]);
                        }
                    }
                    $user->givePermissionTo($tempPermissions);
                }

            }
        } else {
            $this->removeAllRolePermissionByUser($user);
        }

        $nameRole = $user->getRoleNames();

        return $nameRole;
    }

    private function removeAllRolePermissionByUser(User $user)
    {
        $user->syncRoles([]);
        $user->syncPermissions([]);
    }

    public function editRole($id)
    {
        $user = User::findOrFail($id);
            $data = $this->showAccess($user);
        return $data;
    }

    private function showAccess(User $user)
    {
        $arrayJson = array();
        $role = Role::all();
       if (count($role) > 0) {
           $id =0;

            foreach ($role as $roles) {
                $name = $roles->name;
                $array = $roles->getPermissionNames();
                $id ++;
                $treeModels = new TreeModels();
                $treeModels->setId($id);
                $checked = $this->checkRoleByUserId($user, $roles);
                $treeModels->setChecked($checked);
                $treeModels->setText($name);
                if (count($array) > 0) {
                    foreach ($array as $namePer) {
                        $id++;
                        $child = new childModels();
                        $child->setId($id);
                        $checked = false;
                        if ($user->hasRole($roles) && $user->hasDirectPermission($namePer)) {
                            $checked = $this->checkPermissionByUser($user, $namePer);
                        }
                         else {
                            $treeModels->setChecked($checked);
                        }
                        $child->setChecked($checked);
                        $child->setText($namePer);
                        $treeModels->setChildren($child);
                    }
                }

                array_push($arrayJson, $treeModels);
            }
        }
        return $arrayJson;
    }

    private function checkPermissionByUser(User $user, $permission): bool
    {
        $check = false;
        if ($user->hasDirectPermission($permission)) {
            $check = true;
        }
        return $check;
    }

    private function checkRoleByUserId(User $user, $role): bool
    {
        $check = false;
        if ($user->hasRole($role)) {
            $check = true;
        }
        return $check;
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return $users;
    }
}
