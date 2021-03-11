<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    use HasRoles;
    public function __construct()
     {
         $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user = User::all();

         return view('admin.user.index',['user'=>$user]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CreateUserRequest $request)
    {
         User::create([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'userName' => $request['userName'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         $users = User::findOrFail($id);
        return view('admin.user.show',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.user.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
         $input =  $request->all();

         if($file = $request->file('photo_id')){
             $name = time() . $file->getClientOriginalName();
             $file->move('images',$name);
             $photo = Photo::create(['file'=>$name]);
              $input['photo_id'] = $photo->id;

         }

        $input['password'] = bcrypt($request->password);
         $user->firstName = $request->input('firstName');
         $user->lastName = $request->input('lastName');
         $user->userName =$request->input('userName');
          $email = User::all()->where('email',$input['email'])->first();
          if($email === $user->email &&$email !==null ||$email ===null ){
              $user->email = $request->input('email');
          }
         $user->password =$input['password'];
        if(array_key_exists('photo_id',$input)){
            $user->photo_id =$input['photo_id'];
        }

        $user->save();

        $request->session()->flash('update-user','User update success!');
         return  redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

       if($user->photo){
           unlink( public_path() . $user->photo->file);
           $user->photo->delete();
       }
        $user::destroy($id);

       session()->flash('delete-user','Delete  user success!');
        return redirect()->route('user.index');
    }

    public function editRole($id){

        $user = User::findOrFail($id);
        $role = Role::all();
        $arrayIdRole = array();
        $IdRole =$user->roles;
        foreach ($IdRole as $idRoles){
            array_push($arrayIdRole,$idRoles->id);
        }
        return view('admin.user.user_role',compact('role','arrayIdRole','user'));
    }

    /**
     * add role user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addRole( Request $request,$id){

        $user = User::findOrFail($id);
        $input = $request->all();
        $arrayNameRole = array();
        $originRole = Role::all();

        foreach ($originRole as $nameRole){
            array_push($arrayNameRole,$nameRole->name);
        }


            if(array_key_exists('arrayIdRole',$input))
            {
                foreach ($originRole as $role){
                    if(in_array($role,$input['arrayIdRole']) == false){

                        $user->removeRole($role);
                    }
                }
                $user->assignRole($input['arrayIdRole']);
            }else{
                $user->syncRoles([]);
            }
        $request->session()->flash('assignRole-user','Assign role user success!');
           return redirect()->route('user.index');
    }
}
