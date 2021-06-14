<?php

namespace App\Http\Controllers;

use App\Contracts\HomeContract;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private  $homeContract;
    public function __construct(HomeContract $homeContract)
    {
        $this->homeContract =$homeContract;
    }
    //
    /**
     * Display the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function index($id){
       $products =  $this->homeContract->getAll();
         $user =  User::findOrFail($id);
         return view('app.account',compact('user','products'));
   }

    //
    /**
     * Display the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request,$id){
        $input =$request->all();
        $user =  User::findOrFail($id);
        global $result;

        if(array_key_exists('passwordOld',$input) && $input['password'] !== null ){
            $this->validate($request, [
                'passwordOld'=>'required|between:8,255',
                'password' => 'required|between:8,255|confirmed',
            ]);
            if(!count($user->getRoleNames()) && Hash::check($input['passwordOld'], $user->password)){
                $user->phoneNumber = $input['phoneNumber'];
                $user->email = $input['email'];
                $user->password =Hash::make($input['password']);
                $user->firstName = $input['firstName'];
                $user->lastName = $input['lastName'];
                $user->address = $input['address'];
                $user->save();
                $result = "Cập nhật thành công!";
                session()->flash('account-update',$result);
            }else{
                $result = "Sai password!";
                session()->flash('account-update-fail',$result);
            }
        }else{
            $user->phoneNumber = $input['phoneNumber'];
            $user->email = $input['email'];
            $user->firstName = $input['firstName'];
            $user->lastName = $input['lastName'];
            $user->address = $input['address'];
            $user->save();
            $result = "Cập nhật thành công!";
            session()->flash('account-update',$result);
        }
       return redirect()->route('account',$id);
    }
}
