<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    protected $userContract;
    use HasRoles;

    public function __construct(UserContract $userContract)
    {
        $this->middleware('auth');
        $this->userContract = $userContract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->userContract->getAll();
        return view('admin.user.index', ['user' => $result['user'], 'arrRole' => $result['arrayRole']]);

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->userContract->create($request);


        return response()->json(['success' => 'Success add new user!', 'user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $users = $this->userContract->show($id);
      return   response()->view('admin.user.show', ['users'=>$users]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $users = $this->userContract->edit($id);
        return view('admin.user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
          $this->userContract->update($request,$id);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message =  $this->userContract->delete($id);
        return response()->json(['success' => $message]);
    }

    public function editRole($id)
    {
        $responseText = $this->userContract->editRole($id);
        return $responseText;
    }

    /**
     * add role user
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request, $id)
    {

        $result = $this->userContract->addRole($request, $id);
        return response()->json(['success' =>"Success assign access!",'result'=>$result ]);
    }
}
