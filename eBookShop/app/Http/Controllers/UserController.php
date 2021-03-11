<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
         $user->email = $request->input('email');
         $user->password =$input['password'];
         $user->photo_id =$input['photo_id'];
         $user->save();
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

    }
}
